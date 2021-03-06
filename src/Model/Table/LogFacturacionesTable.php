<?php
namespace App\Model\Table;

use Cake\ORM\Table;

/**
 * @property integer $id
 * @property integer $factura_id
 * @property integer $usuario_id
 * @property string  $descripcion
 * @property string  $created
 * @property string  $modified
 * @property integer $estado
 *
 * @author José Alberto Munguia Olmos <munguiaolmos.alberto@gmail.com>
 */
class LogFacturacionesTable extends Table
{
    public function initialize(array $config)
    {
        /**
         * Table's name
         */
        $this->setTable('log_facturaciones');

        /**
         * Behaviors
         */
        $this->addBehavior('Timestamp');

        /**
         * BelongsTo Associations
         */

        // gastos...
        $this->belongsTo('Facturaciones')
            ->setForeignKey('factura_id')
            ->setJoinType('LEFT')
            ->setConditions(['Facturaciones.estado' => 1]);

        // usuarios...
        $this->belongsTo('Usuarios')
            ->setForeignKey('usuario_id')
            ->setJoinType('LEFT')
            ->setConditions(['Usuarios.estado' => 1]);
    }

    /**
     * Guarda en log todas las acciones realizadas en los gastos.
     *
     * @param  array   $attributes Atributos
     * @return boolean             true|false
     */
    public function register(array $attributes)
    {
        $logFacturacion = $this->newEntity($attributes);

        try {
            $logFacturacionObj = $this->save($logFacturacion);
        } catch (Exception $e) {
        }

        return $logFacturacionObj == false ? $logFacturacionObj : true;
    }
}
