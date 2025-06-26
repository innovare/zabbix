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

class WidgetHostGrid extends CWidget {

    onInitialize() {
        super.onInitialize();
        this._grid_container = null;
        this._hosts = null;
    }

    processUpdateResponse(response) {
        this._hosts = response.hosts || [];
        this._columns = response.fields_values.columns;
        this._rows = response.fields_values.rows;
        
        console.log('Hosts data:', this._hosts);
        if (this._hosts.length > 0) {
            console.log('First host structure:', this._hosts[0]);
        }        
        super.processUpdateResponse(response);
        
        
    }

    setContents(response) {
        super.setContents(response);
        
        this._grid_container = this._body.querySelector('.host-grid-container');
        this._setupGrid();
        this._renderHosts();
    }

    onResize() {
        super.onResize();
        if (this._state === WIDGET_STATE_ACTIVE && this._grid_container) {
            this._setupGrid();
        }
    }

    _setupGrid() {
        // Configure CSS Grid
        this._grid_container.style.gridTemplateColumns = `repeat(${this._columns}, 1fr)`;
        this._grid_container.style.gridTemplateRows = `repeat(${this._rows}, 1fr)`;
    }

    _renderHosts() {
        // Clear existing content
        this._grid_container.innerHTML = '';
        const totalCells = this._columns * this._rows;
        let hostIndex = 0;

        for (let i = 0; i < totalCells; i++) {
            const cell = document.createElement('div');
            cell.className = 'host-grid-cell';

            if (hostIndex < this._hosts.length) {
                const host = this._hosts[hostIndex];

                // Debug: Ver los datos del host actual
                console.log(`Host ${hostIndex}:`, host);

                // Set cell content and style based on host status
                cell.textContent = '';  //this._truncateHostName(host.name);
                cell.title = `${host.name} - ${this._getStatusText(host.active_available)}`;
                cell.className += ` ${this._getStatusClass(host.active_available)}`;

                // Add click handler
                cell.addEventListener('click', () => {
                    this._openHostDetails(host.hostid);
                });

                hostIndex++;
            } else {
                // Empty cell
                cell.className += ' host-grid-cell-empty';
                cell.textContent = '';
            }

            this._grid_container.appendChild(cell);
        }
    }

    _truncateHostName(name) {
        return name.length > 8 ? name.substring(0, 6) + '...' : name;
    }

    _getStatusClass(available) {
        switch (parseInt(available)) {
            case 1: // HOST_AVAILABLE_TRUE
                return 'host-status-available';
            case 2: // HOST_AVAILABLE_FALSE
                return 'host-status-unavailable';
            case 0: // HOST_AVAILABLE_UNKNOWN
            default:
                return 'host-status-unknow';
        }
    }

    _getStatusText(available) {
        const status = parseInt(available) || 0;
        switch (status) {
            case 1:
                return t('On');
            case 2:
                return t('Off');
            case 0:
            default:
                return t('Desconocido');
        }
    }

    _openHostDetails(hostid) {
        // Navigate to host details page
        //const url = 'zabbix.php?action=host.view&filter_name=' + encodeURIComponent(hostid);
        const url = 'zabbix.php?action=host.dashboard.view&hostid=' + encodeURIComponent(hostid);
        //zabbix.php?action=host.dashboard.view&hostid=10671
        if (window.opener) {
            window.opener.location.href = url;
        } else {
            window.open(url, '_blank');
        }
    }
}