<?php
namespace McCaulay\Bitcoin\Api;

class ControlApi extends Api
{
    /**
     * Gets information about memory usage.
     *
     * @return object
     */
    public function getMemoryInfo(): object
    {
        return $this->request('getmemoryinfo');
    }

    /**
     * Stops the bitcoin server running.
     *
     * @return void
     */
    public function stop(): void
    {
        $this->request('stop');
    }

    /**
     * The number of seconds that the server has been running.
     *
     * @return integer
     */
    public function uptime(): int
    {
        return $this->request('uptime');
    }
}
