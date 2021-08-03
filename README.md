# Logística S.A.

https://fleshly-trials.000webhostapp.com/

Trabajo práctico final para la materia Programacion Web 2 en UNLaM.

## Descripción general del sistema:

Logística S.A. utiliza un sistema informático interno para controlar su flota de vehículos.

La empresa cuenta con una importante flota propia de vehículos y realiza viajes a todo el país.
El sistema permite el acceso desde cualquier conexión a internet, puesto que se utilizará para
chequear en todo momento la posición y recorrido de los vehículos durante los viajes.

El sistema permite cinco niveles de acceso (roles), también se listan las funcionalidades disponibles para cada uno:
- Administrador: Encargado de administrar el sistema, trabajar con los reportes de nivel gerencial y realizar la carga de roles y usuarios. 
  * Usuarios (ver y editarlos, asignar roles).
  * Reportes (Generar Proforma y Mantenimiento de Vehículos).
  * Clientes.
  * Flota de Vehiculos.
  * Facturas.
  * Consultar posición de vehículo.
  * Mantenimiendo de Vehiculos.
  * Viajes.
  
- Supervisor: Realiza las tareas de carga y consulta de los datos en las oficinas centrales.
  * Clientes.
  * Flota de Vehiculos.
  * Facturas.
  * Consultar posición de vehículo.
  * Viajes.
  
- Encargado del taller: Actualiza los datos de mantenimiento.
  * Consultar Posicion de vehiculo.
  * Mantenimiento de Vehículos.
  
- Chofer: Utiliza el sistema para actualizar los datos durante el viaje.
  * Viajes.
  
- Mecánico: Realiza el mantenimiento de los vehiculos, este no utiliza la aplicación. Los encargados de taller asignan mecánicos a los services.


## Descripción de funcionalidades:

- Seguridad del sistema (autenticación y autorización (según rol por ejemplo) en toda la aplicación).
- ABM de usuarios, Roles, Log-in, manejo de claves y permisos. Todos los usuarios se registran como usuarios
llanos y el administrador les otorga roles una vez registrados.
- Administración de la flota de vehículos. ABM, estado, reportes, posición actual, etc.
- Administración del plantel de empleados.
- Administración de Viajes. ABM, vehículo, origen, destino, chofer asignado, cliente, tipo de carga,
fechas, tiempo estimado de viaje, tiempo real, desviación, kilómetros recorridos previstos,
kilómetros recorridos reales, combustible consumido (previsto y real), etc.
- Mantenimiento de los vehículos. ABM, services, km de la unidad, costo, service
interno/externo, mecánico interviniente, repuestos cambiados, etc.
- Seguimiento de los vehículos en viaje. En cualquier momento el supervisor, el administrador y/o
el encargado de taller pueden consultar la posición actual del vehículo en un mapa.
- Facturación de los viajes a los clientes en base a la proforma generada.

La aplicación permite a los choferes mediante los celulares que se les
entregan, y a partir de un código leído de un QR, enviar un reporte diario de posición a partir del GPS del
celular. Se genera un codigo QR único para cada viaje, de
manera de poder realizar el seguimiento correspondiente. A través de la misma aplicación los choferes
informan cargas de combustible, desvios, posición actual y gastos.

Para cada viaje se asigna un chofer, una unidad de transporte y un remolque.


## Detalles técnicos:

- Se utiliza una base de datos MySQL para almacenar los datos.
- El sistema está implementado con el lenguaje de programación PHP desde el lado del Servidor.
- La arquitectura de la aplicación está basada en un modelo MVC.
- La interfaz está implementada en el Framework W3.CSS.
- El manejo de posicionamiento y mapas se realiza mediante HTML Geolocation API.


## Login de varios usuarios ejemplo:
** Por motivos de seguridad no se proporciona un login de administrador. **

EMAIL - CONTRASEÑA - ROL:

- marialopez@gmail.com - marialopez - Supervisora
- franciscovegas@gmail.com - franciscovegas - Encargado de Taller
- gastonperez@gmail.com - gastonperez - Chofer
- mariogimenez@gmail.com - mariogimenez - Chofer
- rodrigoelizald@gmail.com - rodrigoelizald - Chofer
- juanperez@gmail.com - juanperez - Chofer
- mariorodriguez@gmail.com - mariorodriguez - Chofer


## Carga de datos de un viaje:

Los choferes informan datos del viaje a partir de un codigo QR generado en la proforma, que llevan a una URL dinamica https://fleshly-trials.000webhostapp.com/travel/loadData?id= [ID DE VIAJE]. Esta proforma es impresa y los choferes deberan llevarla con ellos/as para poder acceder al QR y/o ver datos del viaje.

Ejemplo: Loguearse con el usuario juanperez@gmail.com e ir a Viajes. La proforma del viaje con ID 5 contiene un QR que dirige a https://fleshly-trials.000webhostapp.com/travel/loadData?id=5, allí se podran informar nuevos datos del viaje.


Como no se proporciona un login de un administrador, se adjuntan imagenes sobre la funcionalidad de usuarios (en orden: Ver Usuarios, Ver Usuario, Editar usuario y asignar roles, Generar Proforma):

![image](https://user-images.githubusercontent.com/58083159/127936163-0cdd00af-7972-4505-94a2-025c4a92d725.png)

![image](https://user-images.githubusercontent.com/58083159/127936192-6483f7a2-2498-4f5e-b1d5-9d0480e5cc2f.png)

![image](https://user-images.githubusercontent.com/58083159/127936202-d2e8508b-e09f-4d90-8395-b752791809db.png)

![image](https://user-images.githubusercontent.com/58083159/127936212-f8290845-1508-44cb-a433-7c6818139822.png)

En caso de error "Connection failed: MySQL server has gone away", actualizar la página y debería funcionar nuevamente. Este error se debe a que el hosting gratis 000webhost tiene conexiones limitadas y se agregaron politicas de limitación para evitar el abuso de spammers.
