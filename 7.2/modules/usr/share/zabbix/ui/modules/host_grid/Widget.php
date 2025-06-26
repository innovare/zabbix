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
**/

namespace Modules\HostGrid;

use Zabbix\Core\CWidget;

class Widget extends CWidget {

    public const DEFAULT_COLUMNS = 10;
    public const DEFAULT_ROWS = 5;

    public function getTranslationStrings(): array {
        return [
            'class.widget.js' => [
                'No data' => _('No data'),
                'Host unavailable' => _('Host unavailable'),
                'Host available' => _('Host available'),
                'Unknown status' => _('Unknown status')
            ]
        ];
    }
}