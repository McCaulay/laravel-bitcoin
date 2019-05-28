<?php
namespace McCaulay\Bitcoin\Api;

class GenerateApi extends Api
{
    /**
     * Nearly instantly generates blocks.
     *
     * @param $blocks The number of blocks to generate. The RPC call will not
     * return until all blocks have been generated or the maxium number of
     * iterations has been reached.
     * @param $maxTries The maximum number of iterations that are tried to
     * create the requested number of blocks. Default is 1000000.
     * @return array
     */
    public function generate(int $blocks, int $maxTries = 1000000): array
    {
        return $this->request('generate', [$blocks, $maxTries]);
    }

    /**
     * Mines blocks immediately to a specified address.
     *
     * @param $blocks The number of blocks to generate. The RPC call will not
     * return until all blocks have been generated or the maxium number of
     * iterations has been reached
     * @param $address The address to send the newly generated Bitcoin to.
     * @param $maxTries The maximum number of iterations that are tried to
     * create the requested number of blocks. Default is 1000000.
     * @return array
     */
    public function generateToAddress(int $blocks, string $address, int $maxTries = 1000000): array
    {
        return $this->request('generateToAddress', [$blocks, $address, $maxTries]);
    }
}
