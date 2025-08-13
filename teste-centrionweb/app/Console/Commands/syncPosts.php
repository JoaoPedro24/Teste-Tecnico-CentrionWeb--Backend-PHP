<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class SyncPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza os posts da API externa com o banco de dados.';

    private Client $client;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com/'
        ]);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $response = $this->client->get('posts');

            if ($response->getStatusCode() !== 200) {
                $this->error('Erro: status HTTP inesperado ' . $response->getStatusCode());
                return 1;
            }

            $data = json_decode($response->getBody()->getContents(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error('Erro ao decodificar JSON: ' . json_last_error_msg());
                return 1;
            }

            if (empty($data)) {
                $this->error('Nenhum post encontrado na API externa.');
                return 404;
            }

            foreach ($data as $postData) {
                \App\Models\Post::updateOrCreate(
                    ['id' => $postData['id']],
                    [
                        'userId' => $postData['userId'],
                        'title' => $postData['title'],
                        'body' => $postData['body'],
                    ]
                );
            }

            $this->info('Posts sincronizados com sucesso!');
            return 0;

        } catch (ConnectException $e) {
            $this->error('Erro de conexão com a API externa: ' . $e->getMessage());
            return 1;

        } catch (RequestException $e) {
            $this->error('Erro na requisição da API externa: ' . $e->getMessage());
            if ($e->hasResponse()) {
                $this->error('Resposta da API: ' . $e->getResponse()->getBody()->getContents());
            }
            return 1;

        } catch (\Exception $e) {
            $this->error('Erro inesperado: ' . $e->getMessage());
            return 1;
        }
    }
}
