<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class ApiCustom extends Model {
    // use HasFactory;

    private $host;
    private $user_agent_key;
    private $user_agent_val;
    private $auth_key;
    private $auth_val;
    private $content_type;

    protected $method = 'GET';
    protected $headers;
    protected $body;

    public function __construct() {
        parent::__construct();
        $this->host = config('api_config.host');
        $this->user_agent_key = config('api_config.user_agent_key');
        $this->user_agent_val = config('api_config.user_agent_val');
        $this->auth_key = config('api_config.auth_key');
        $this->auth_val = config('api_config.auth_val');
        $this->content_type = config('api_config.content_type');
    }

    public function set_host($host) {
        $this->host = $host;
    }

    public function get_host() {
        return $this->host;
    }

    public function set_method($method) {
        $this->method = $method;
    }

    public function get_method() {
        return strtoupper($this->method);
    }

    public function set_header($data, $is_withContentType = false, $is_withToken = false) {
        $headers = [];

        foreach ($data as $key => $val) {
            $headers[$key] = $val;
        }

        $headers[$this->user_agent_key] = $this->user_agent_val;

        if ($is_withToken) {
            $headers[$this->auth_key] = $this->auth_val;
        }

        if ($is_withContentType) {
            $headers['Content-Type'] = $this->content_type;
        }

        $this->headers = $headers;
    }

    public function get_header() {
        return $this->headers;
    }

    public function set_content_type($val) {
        $this->content_type = $val;
    }

    public function get_content_type($val) {
        return $this->content_type;
    }

    public function set_body($data) {
        $dataArr = null;
        $index_body = null;

        if ($this->method == 'POST') {
            switch ($this->content_type) {
                case 'application/x-www-form-urlencoded':
                    $index_body = 'form_params';
                    break;
                case 'text/plain':
                    $index_body = false;
                    break;
                default:
                    $index_body = 'multipart';
                    break;
            }

            if (!empty($index_body)) {
                $dataArr = array(
                    $index_body => $data
                );
                // $dataArr = json_encode($dataArr);
            } else {
                $dataArr = $data;
            }
        }


        $this->body = $dataArr;
    }

    public function get_body() {
        return $this->body;
    }

    public function exec() {
        // Reff : https://docs.guzzlephp.org/en/stable/quickstart.html#making-a-request
        $client = new \GuzzleHttp\Client();

        $host = $this->get_host();
        $headers = $this->get_header();
        $method = $this->get_method();
        $body = $this->get_body();

        // dd($method, $host, $headers, $body);

        $request = new Request($method, $host, $headers);

        if (!empty($body)) {
            $promise = $client->sendAsync($request, $body)->then(function ($response) {
                return $response->getBody()->getContents();
            });
        } else {
            $promise = $client->sendAsync($request)->then(function ($response) {
                return $response->getBody()->getContents();
            });
        }

        $result = $promise->wait();

        $response = json_decode($result, true);
        return $response;
    }
}
