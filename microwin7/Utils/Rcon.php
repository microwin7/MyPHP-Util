<?php

namespace microwin7\Utils;

use \microwin7\Configs\Main;
use \microwin7\Exceptions\RconConnectException;
use \microwin7\Exceptions\RequiredArgumentMissing;
use \microwin7\Exceptions\SolutionDisabledException;
use \microwin7\Exceptions\ServerNotSelected;

class Rcon
{
    protected $server;

    public function selectServer(string $server_name)
    {
        $this->server = $server_name;
        return $this;
    }
    public function sendRconCommand(string $command, $username = '', $check_correct_server = true): void
    {
        $this->checkEmptyServer();
        if ($check_correct_server) $this->checkServer();
        $rcon = new \microwin7\libs\Rcon(
            Main::SERVERS[$this->server]['host'],
            Main::SERVERS[$this->server]['port'],
            Main::SERVERS[$this->server]['rcon']['password'],
            Main::SERVERS[$this->server]['rcon']['timeout'],
        );
        if (!$rcon->connect()) throw new RconConnectException;
        $rcon->sendCommand($command . ' ' . $username);
        $rcon->disconnect();
    }
    private function checkEmptyServer(): void
    {
        if (empty($this->server)) throw new ServerNotSelected;
    }
    private function checkServer()
    {
        if (!@Main::SERVERS[Main::getCorrectServer($this->server)]['rcon']['enable']) throw new SolutionDisabledException;
    }
    public function teleportToSpawn(string $username): void
    {
        if(empty($username)) throw new RequiredArgumentMissing;
        $this->sendRconCommand('otp', $username);
    }
    public function broadcast(string $command): array
    {
        $deny_servers = [];
        foreach (Main::SERVERS as $server => $value) {
            if (!@$value['rcon']['enable']) continue;
            $this->server = $server;
            try {
                $this->sendRconCommand($command, '', false);
            } catch (RconConnectException $e) {
                $deny_servers[] = $server;
            } catch (SolutionDisabledException $e) {
            }
        }
        return $deny_servers;
    }
}
