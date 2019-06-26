<?php
namespace app\push\controller;

use think\worker\Server;

class Worker extends Server
{
    protected $socket = 'websocket://worker.nb27.cn:1827';

    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $connection->send('我收到你的信息了');
    }

// 当客户端发送消息过来时，转发给所有人
    public function handle_message($connection, $data)
    {
        foreach($this->worker->connections as $conn)
        {
            $conn->send("user[{$connection->uid}] said: $data");
        }
    }

// 当客户端断开时，广播给所有客户端
    public function handle_close($connection)
    {
        foreach($this->worker->connections as $conn)
        {
            $conn->send("user[{$connection->uid}] logout");
        }
    }
    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {

    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}