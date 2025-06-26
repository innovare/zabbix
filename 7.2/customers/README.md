# Procedimiento para descargar los archivos de configuración

Uso:

1. Descargar los archivos de configuración del {customer_name}

wget https://https://github.com/innovare/zabbix/tree/main/7.2/customers/zabbix_agent2_{customer_name}.conf
wget https://https://github.com/innovare/zabbix/tree/main/7.2/customers/zabbix_agent2.userparams_{customer_name}.conf

2. Mover los archivos a la ruta /etc/zabbix/ y reemplazar los existentes

mv zabbix_agent2_{customer_name}.conf /etc/zabbix/zabbix_agent2.conf
mv zabbix_agent2.userparams_{customer_name}.conf /etc/zabbix/zabbix_agent2.userparams.conf

3. Cambiar el nombre del Hostname que coincida con el del servidor con el comando
sed -i 's/^Hostname=.*$/Hostname=nombre-del-host/'

Donde: nombre-del-host es el nombre del servidor.

4. Reiniciar los servicios del Agente2 Zabbix y Registrar el Hostname en el servidor de Monitoreo

systemctl restart zabbix-agent2


#### Lanzamiento (20/06/2025):
