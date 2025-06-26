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
** Host Grid widget form.
**
**/

namespace Modules\HostGrid\Includes;

use Modules\HostGrid\Widget;
use Zabbix\Widgets\{
    CWidgetField,
    CWidgetForm
};
use Zabbix\Widgets\Fields\{
    CWidgetFieldIntegerBox,
    CWidgetFieldMultiSelectGroup,
    CWidgetFieldCheckBox
};


class WidgetForm extends CWidgetForm {

    public function addFields(): self {
        return $this
            ->addField(
                (new CWidgetFieldIntegerBox('columns', _('Columns')))
                    ->setDefault(Widget::DEFAULT_COLUMNS)
                    ->setFlags(CWidgetField::FLAG_NOT_EMPTY | CWidgetField::FLAG_LABEL_ASTERISK)
            )
            ->addField(
                (new CWidgetFieldIntegerBox('rows', _('Rows')))
                    ->setDefault(Widget::DEFAULT_ROWS)
                    ->setFlags(CWidgetField::FLAG_NOT_EMPTY | CWidgetField::FLAG_LABEL_ASTERISK)
            )
            ->addField(
                new CWidgetFieldMultiSelectGroup('groupids', _('Host groups'))
            )
            ->addField(
                new CWidgetFieldCheckBox('show_disabled', _('Show disabled hosts'))
            );
    }
}