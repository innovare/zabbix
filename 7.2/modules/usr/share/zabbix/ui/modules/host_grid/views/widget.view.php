<?php
/*
** Copyright (C) 2001-2025 Innovare e-Business s.a.c.
**
** This program is free software: you can redistribute it and/or modify it under the terms of
** the GNU Affero General Public License as published by the Free Software Foundation, version 3.
**
** This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
** without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
** See the GNU Affero General Public License for more details.
**
** You should have received a copy of the GNU Affero General Public License along with this program.
** If not, see <https://www.gnu.org/licenses/>.
**
** Host Grid widget view.
**
** @var CView $this
** @var array $data
**
**/

/**
 */

(new CWidgetView($data))
    ->addItem(
        (new CDiv())->addClass('host-grid-container')
    )
    ->setVar('hosts', $data['hosts'])
    ->setVar('fields_values', $data['fields_values'])
    ->show();