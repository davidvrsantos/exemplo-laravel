<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

trait ManagesTransactionsService
{
    /**
     * @var bool Define se fará uso de transação
     */
    private bool $managesTransaction = true;

    /**
     * @param bool $value
     *
     * @return $this
     */
    public function setManagesTransaction(bool $value): self
    {
        $this->managesTransaction = $value;

        return $this;
    }

    /**
     * Retorna as conexões que serão transacionadas. Deixando `null` será considerada a conexão padrão.
     *
     * @return array
     */
    protected function connectionsToTransact(): array
    {
        return property_exists($this, 'connectionsToTransact')
            ? $this->connectionsToTransact
            : [null];
    }

    /**
     * @param string $method
     *
     * @return void
     */
    private function transact(string $method)
    {
        if (!$this->managesTransaction) {
            return;
        }

        foreach ($this->connectionsToTransact() as $connection) {
            DB::connection($connection)->{$method}();
        }
    }

    /**
     * @return void
     */
    protected function beginTransaction(): void
    {
        $this->transact('beginTransaction');
    }

    /**
     * @return void
     */
    protected function commit(): void
    {
        $this->transact('commit');
    }

    /**
     * @return void
     */
    protected function rollBack(): void
    {
        $this->transact('rollBack');
    }

    /**
     * @param \Closure $callback
     *
     * @return mixed
     * @throws \Throwable
     */
    public function transaction(\Closure $callback)
    {
        if (!$this->managesTransaction) {
            return $callback();
        }

        $this->beginTransaction();

        try {
            $callbackResult = $callback();

            $this->commit();

            return $callbackResult;
        } catch (\Throwable $exception) {
            $this->rollBack();

            throw $exception;
        }
    }
}
