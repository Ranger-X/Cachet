<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Bus\Commands\ComponentGroup;

use CachetHQ\Cachet\Models\ComponentGroup;

/**
 * This is the update component group command.
 *
 * @author James Brooks <james@alt-three.com>
 */
final class UpdateComponentGroupCommand
{
    /**
     * The component group.
     *
     * @var \CachetHQ\Cachet\Models\ComponentGroup
     */
    public $group;

    /**
     * The component group name.
     *
     * @var string
     */
    public $name;

    /**
     * The component group description.
     *
     * @var int
     */
    public $order;

    /**
     * Is the component group collapsed?
     *
     * @var int
     */
    public $collapsed;

    /**
     * Acceptable SLA percent
     *
     * @var float
     */
    public $acceptable_sla;

    /**
     * Current SLA percent
     *
     * @var float
     */
    public $sla;

    /**
     * Is the SLA showing on statuspage?
     *
     * @var bool
     */
    public $show_sla;

    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'name'      => 'string',
        'order'     => 'int',
        'collapsed' => 'int|between:0,3',
        'show_sla'  => 'bool',
    ];

    /**
     * Create a add component group command instance.
     *
     * @param \CachetHQ\Cachet\Models\ComponentGroup $group
     * @param string                                 $name
     * @param int                                    $order
     * @param int                                    $collapsed
     * @param float                                  $acceptable_sla
     * @param float                                  $sla
     * @param bool                                   $show_sla
     *
     * @return void
     */
    public function __construct(ComponentGroup $group, $name, $order, $collapsed, $acceptable_sla, $sla, $show_sla)
    {
        $this->group = $group;
        $this->name = $name;
        $this->order = (int) $order;
        $this->collapsed = $collapsed;
        $this->acceptable_sla = $acceptable_sla;
        $this->sla = $sla;
        $this->show_sla = $show_sla;
    }
}
