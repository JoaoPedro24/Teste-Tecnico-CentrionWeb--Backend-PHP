<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class syncPosts extends Command
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

        // Inicializa o Guzzle Client com base URI
        $this->client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
            'timeout'  => 10.0,
        ]);
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
            try {
                $response = $this->client->get('posts');

                $data = json_decode($response->getBody()->getContents(), true);
                
                foreach ($data as $postData) {
                    \App\Models\Post::Create(
                        [
                            'userId' => $postData['userId'],
                            'title' => $postData['title'],
                            'body' => $postData['body'],
                        ]
                    );
                }

                $this->info('Posts sincronizados com sucesso!');

            

            } catch (\GuzzleHttp\Exception\RequestException $e) {
                $this->error('Error fetching data: ' . $e->getMessage());
                if ($e->hasResponse()) {
                    $this->error('Response body: ' . $e->getResponse()->getBody()->getContents());
                }
            }
        }
    }

