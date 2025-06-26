# Procedimiento para descargar los archivos de configuración

Uso:
1. Descargar los archivos de configuración del {customer_name}
* curl https://github.com/innovare/zabbix/tree/main/7.2/customers/zabbix_agent2_{customer_name}.conf --output zabbix_agent2_{customer_name}.conf
* curl https://github.com/innovare/zabbix/tree/main/7.2/customers/zabbix_agent2.userparams_{customer_name}.conf --output zabbix_agent2.userparams_{customer_name}.conf

2. Mover los archivos a la ruta /etc/zabbix/ y reemplazar los existentes
* mv /etc/zabbix/zabbix_agent2.conf /etc/zabbix/zabbix_agent2_backup.conf
* mv zabbix_agent2_{customer_name}.conf /etc/zabbix/zabbix_agent2.conf
* mv zabbix_agent2.userparams_{customer_name}.conf /etc/zabbix/zabbix_agent2.userparams.conf

3. Cambiar el nombre del Hostname que coincida con el del servidor con el comando
* sed -i 's/^Hostname=.*$/Hostname=nombre-del-host/' /etc/zabbix/zabbix_agent2.conf
* Nota: <nombre-del-host> es el nombre del servidor.

4. Instalar paquetes adicionales y reiniciar Zabbix Agent2*
* dnf install jq

5. Añadir el usuaro zabbix al Grupo de WithSecure Elements Connector
* usermod -aG fspms zabbix
* Nota: (ejecutar despuesta de instlar WithSecure Elements Connector)

6. Reiniciar los servicios y agregar el host en la Consola de Monitoreo
* systemctl restart zabbix-agent2

#### Lanzamiento (20/06/2025):
