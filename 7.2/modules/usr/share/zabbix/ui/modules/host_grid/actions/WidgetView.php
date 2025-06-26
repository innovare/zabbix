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
**/

namespace Modules\HostGrid\Actions;

use API;
use CControllerDashboardWidgetView;
use CControllerResponseData;
Use CItemGeneral;

class WidgetView extends CControllerDashboardWidgetView {

    protected function doAction(): void {
        $columns = $this->fields_values['columns'];
        $rows = $this->fields_values['rows'];
        $groupids = $this->fields_values['groupids'];
        $show_disabled = $this->fields_values['show_disabled'];

        // Prepare host search parameters
        $host_params = [
            'output' => ['hostid', 'name', 'status', 'available', 'active_available'],
            'selectInterfaces' => ['type', 'ip', 'dns', 'port', 'available', 'error'],
            //'preservekeys' => true,
            'sortfield' => 'name',
            'limit' => $columns * $rows
        ];

        // Filter by host groups if specified
        if ($groupids) {
            $host_params['groupids'] = $groupids;
        }

        // Filter by host status
        if (!$show_disabled) {
            $host_params['filter']['status'] = HOST_STATUS_MONITORED;
        }

        // Get hosts from Zabbix API
        try {
            $hosts = API::Host()->get($host_params);
        } catch (Exception $e) {
            $hosts = [];
        }

        $this->setResponse(new CControllerResponseData([
            'name' => $this->getInput('name', $this->widget->getName()),
            'hosts' => $hosts,
            'fields_values' => $this->fields_values,
            'user' => [
                'debug_mode' => $this->getDebugMode()
            ]
        ]));
    }
}