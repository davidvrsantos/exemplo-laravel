<?php

namespace App\Services\Contracts;

use App\Services\ManagesTransactionsService;
use Illuminate\Database\Eloquent\Model;

abstract class DatabaseStorageService
{
    use ManagesTransactionsService;

    const MODE_CREATION = 'create';

    const MODE_UPDATE = 'update';

    /**
     * @var Model
     */
    protected Model $model;

    protected array $data;

    protected Model $modelClass;

    /**
     * @param string $mode
     */
    protected abstract function prepareDataForStorage(string $mode): void;

    /**
     * @param Model $model
     * @return \App\Services\Contracts\DatabaseStorageService
     */
    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param array $data
     * @param string $mode
     * @return $this
     */
    public function setData(array $data, string $mode = self::MODE_CREATION): self
    {
        $this->data = $data;

        $this->prepareDataForStorage($mode);

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setDataForUpdate(array $data): self
    {
        return static::setData($data, self::MODE_UPDATE);
    }

    /**
     * Retorna uma instância da classe de model em questão.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public final function getModel()
    {
        return $this->model ?: new $this->modelClass;
    }

    /**
     * Retorna um query builder construído a partir do Model específico.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public final function getQuery()
    {
        return $this->getModel()::query();
    }

    /**
     * Insere uma entidade no banco dados
     *
     * @return Model
     */
    public abstract function create(): Model;

    /**
     * Atualiza uma entidade no banco de dados
     *
     * @return Model
     */
    public abstract function replace(): Model;

    /**
     * Remove uma entidade no banco de dados
     *
     * @param int $id
     * @return mixed
     */
    public abstract function destroy(int $id): bool;
}
