<?php
namespace McCaulay\Bitcoin\Api;

class NetworkApi extends Api
{
    /**
     * Attempts to add or remove a node from the addnode list, or to try a
     * connection to a node once.
     *
     * @see https://bitcoin.org/en/developer-reference#addnode
     * @param $node The node to add as a string in the form of <IP address>:<port>.
     * The IP address may be a hostname resolvable through DNS, an IPv4 address,
     * an IPv4-as-IPv6 address, or an IPv6 address.
     * @param $command What to do with the IP address above. Options are:
     * "add" to add a node to the addnode list. Up to 8 nodes can be added
     * additional to the default 8 nodes. Not limited by -maxconnections
     * "remove" to remove a node from the list. If currently connected, this will
     * disconnect immediately.
     * "onetry" to immediately attempt connection to the node even if the outgoing
     * connection slots are full; this will only attempt the connection once.
     * @return void
     */
    public function addNode(string $node, string $command): void
    {
        $this->request('addNode', [$node, $command]);
    }

    /**
     * Clears list of banned nodes.
     *
     * @see https://bitcoin.org/en/developer-reference#clearbanned
     * @return void
     */
    public function clearBanned(): void
    {
        $this->request('clearBanned');
    }

    /**
     * Immediately disconnects from a specified node.
     *
     * @see https://bitcoin.org/en/developer-reference#disconnectnode
     * @param $node The hostname/IP address and port of node to disconnect.
     * @return void
     */
    public function disconnectNode(string $node): void
    {
        $this->request('disconnectNode', [$node]);
    }

    /**
     * Gets information about the given added node, or all added nodes (except
     * onetry nodes). Only nodes which have been manually added using the addnode
     * RPC will have their information displayed.
     *
     * @see https://bitcoin.org/en/developer-reference#getaddednodeinfo
     * @param $details Set to true to display detailed information about each
     * added node; set to false to only display the IP address or hostname and
     * port added.
     * @param $node The node to get information about in the same <IP address>:<port>
     * format as the addnode RPC. If this parameter is not provided, information
     * about all added nodes will be returned.
     * @return array
     */
    public function getAddedNodeInfo(bool $details, string $node = null): array
    {
        $parameters = [$details];
        if ($node != null) {
            $parameters[] = $node;
        }
        return $this->request('getAddedNodeInfo', $parameters);
    }

    /**
     * Gets the number of connections to other nodes.
     *
     * @see https://bitcoin.org/en/developer-reference#getconnectioncount
     * @return int
     */
    public function getConnectionCount(): int
    {
        return $this->request('getConnectionCount');
    }

    /**
     * Gets information about network traffic, including bytes in, bytes out,
     * and the current time.
     *
     * @see https://bitcoin.org/en/developer-reference#getnettotals
     * @return object|array
     */
    public function getNetTotals()
    {
        return $this->request('getNetTotals');
    }

    /**
     * Gets information about the node’s connection to the network.
     *
     * @see https://bitcoin.org/en/developer-reference#getnetworkinfo
     * @return object|array
     */
    public function getNetworkInfo()
    {
        return $this->request('getNetworkInfo');
    }

    /**
     * Gets data about each connected network node.
     *
     * @see https://bitcoin.org/en/developer-reference#getpeerinfo
     * @return object|array
     */
    public function getPeerInfo()
    {
        return $this->request('getPeerInfo');
    }

    /**
     * Lists all banned IPs/Subnets.
     *
     * @see https://bitcoin.org/en/developer-reference#listbanned
     * @return object|array
     */
    public function listBanned()
    {
        return $this->request('listBanned');
    }

    /**
     * The ping message helps confirm that the receiving peer is still connected.
     * If a TCP/IP error is encountered when sending the ping message (such as a
     * connection timeout), the transmitting node can assume that the receiving
     * node is disconnected. The response to a ping message is the pong message.
     *
     * Before protocol version 60000, the ping message had no payload. As of
     * protocol version 60001 and all later versions, the message includes a
     * single field, the nonce.
     *
     * @see https://bitcoin.org/en/developer-reference#ping
     * @param $nonce Random nonce assigned to this ping message. The responding
     * pong message will include this nonce to identify the ping message to which
     * it is replying.
     * @return object|array
     */
    public function ping(string $nonce)
    {
        return $this->request('ping', [$nonce]);
    }

    /**
     * Attempts add or remove a IP/Subnet from the banned list.
     *
     * @see https://bitcoin.org/en/developer-reference#setban
     * @param $node The node to add or remove as a string in the form of <IP address>.
     * The IP address may be a hostname resolvable through DNS, an IPv4 address,
     * an IPv4-as-IPv6 address, or an IPv6 address.
     * @param $command What to do with the IP/Subnet address above. Options are:
     * "add" to add a node to the addnode list.
     * "remove" to remove a node from the list. If currently connected, this will
     * disconnect immediately.
     * @param $time Time in seconds how long (or until when if absolute is set)
     * the entry is banned. The default is 24h which can also be overwritten by
     * the -bantime startup argument.
     * @param $absolute If set, the bantime must be a absolute timestamp in
     * seconds since epoch (Jan 1 1970 GMT).
     * @return void
     */
    public function setBan(string $node, string $command, int $time = null, bool $absolute = null): void
    {
        $parameters = [$node, $command];
        if ($time != null) {
            $parameters[] = $time;
        }
        if ($absolute != null) {
            $parameters[] = $absolute;
        }
        $this->request('setBan', $parameters);
    }

    /**
     * Disables/enables all P2P network activity.
     *
     * @see https://bitcoin.org/en/developer-reference#setnetworkactive
     * @param $activate Set to true to enable all P2P network activity. Set to false to disable all P2P network activity.
     * @return void
     */
    public function setNetworkActive(bool $activate): void
    {
        $this->request('setNetworkActive', [$activate]);
    }
}
