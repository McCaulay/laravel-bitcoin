<?php
namespace McCaulay\Bitcoin\Api;

class ControlApi extends Api
{
    /**
     * Gets information about memory usage.
     *
     * @see https://bitcoin.org/en/developer-reference#getmemoryinfo
     * @return object|array
     */
    public function getMemoryInfo()
    {
        return $this->request('getMemoryInfo');
    }

    /**
     * Stops the bitcoin server running.
     *
     * @see https://bitcoin.org/en/developer-reference#stop
     * @return void
     */
    public function stop(): void
    {
        $this->request('stop');
    }

    /**
     * The number of seconds that the server has been running.
     *
     * @see https://bitcoin.org/en/developer-reference#uptime
     * @return integer
     */
    public function uptime(): int
    {
        return $this->request('uptime');
    }
}
