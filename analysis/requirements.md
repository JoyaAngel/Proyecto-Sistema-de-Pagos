# Funcionalidades generales del sistema

## Requisitos Funcionales:

### 1. Autenticación de usuarios:
* El sistema debe mostrar un formulario de inicio de sesión con dos campos:
    * Correo electrónico (Cadena, obligatorio).
    * Contraseña (Cadena, obligatorio).
* El formulario debe tener un botón de "Iniciar sesión" que valide los datos ingresados contra los usuarios registrados.
* Si los datos no son válidos, mostrar un mensaje de error.
* Implementar validación simple de formato para el correo electrónico (e.g., contiene "@" y un dominio).

### 2. Gestión de Clientes:
* Agregar cliente:
    * El sistema debe mostrar un formulario con los siguientes campos:
        * Razón social (Cadena, obligatorio).
        * Tipo (Bandera, "Persona Física" o "Moral", obligatorio).
        * RFC (Cadena, obligatorio, formato alfanumérico de al menos 12 caracteres).
        * Domicilio fiscal (Cadena, opcional).
        * Email (Cadena, obligatorio, con validación de formato).
        * Teléfono (Cadena, opcional).
    * Validar que el RFC y el correo sean únicos al registrar un nuevo cliente.
* Listar clientes:
    * Tabla que muestre los clientes con columnas: Razón social (Cadena), RFC (Cadena), Email (Cadena), Teléfono (Cadena).
* Editar cliente:
    * Seleccionar un cliente desde la lista y abrir un formulario con los datos prellenados.
* Eliminar cliente:
    * Botón para eliminar junto a cada cliente, con confirmación.

### 3. Gestión de Proveedores:
* Agregar proveedor:
    * El sistema debe mostrar un formulario con los siguientes campos:
        * Razón social (Cadena, obligatorio).
        * Tipo (Bandera, "Persona Física" o "Moral", obligatorio).
        * RFC (Cadena, obligatorio, formato alfanumérico de al menos 12 caracteres).
        * Domicilio fiscal (Cadena, opcional).
        * Email (Cadena, obligatorio, con validación de formato).
        * Teléfono (Cadena, opcional).
    * Validar que el RFC y el correo sean únicos al registrar.
* Listar proveedores:
    * Tabla que muestre los proveedores con columnas: Razón social (Cadena), RFC (Cadena), Email (Cadena), Teléfono (Cadena).
* Editar proveedor:
    * Seleccionar un proveedor desde la lista y abrir un formulario con los datos prellenados.
* Eliminar proveedor:
    * Botón para eliminar junto a cada proveedor, con confirmación.

### 4. Gestión de Proyectos:
* Agregar proyecto:
    * El sistema debe mostrar un formulario con los siguientes campos:
        * Nombre del proyecto (Cadena, obligatorio).
        * Cliente (Lista desplegable de clientes registrados, obligatorio).
        * Fecha de inicio (Fecha, obligatorio, formato DD/MM/AAAA).
        * Fecha de fin (Fecha, opcional, formato DD/MM/AAAA).
        * Subtotal (Número, obligatorio).
        * Costo total (Número, calculado automáticamente, obligatorio).
        * IVA (Número, calculado automáticamente).
        * Concepto (Cadena, opcional).
        * Comentarios adicionales (Cadena, opcional).
    * Validar que el cliente sea obligatorio antes de permitir el registro.
* Listar proyectos:
    * Tabla que muestre los proyectos con columnas: Nombre (Cadena), Cliente (Cadena), Costo total (Número), IVA (Número), Subtotal (Número).
* Editar proyecto:
    * Seleccionar un proyecto desde la lista y abrir un formulario con los datos prellenados.
    * Opción para filtrar proyectos por estado (activo/inactivo).
* Eliminar proyecto:
    * Botón para eliminar junto a cada proyecto, con confirmación.
* Cambiar estado de proyecto:
    * Botón para cambiar el estado de un proyecto entre activo e inactivo (Bandera).

### 5. Gestión de Anticipos:
* Registrar anticipo:
    * Formulario con los campos:
        * Seleccionar cliente (Lista desplegable de clientes registrados, obligatorio).
        * Seleccionar proyecto (Lista desplegable de proyectos activos, obligatorio).
        * Monto del anticipo (Número, obligatorio).
        * Fecha del anticipo (Fecha, obligatorio, formato DD/MM/AAAA).
        * Método de pago (Selección: "Depósito" o "Transferencia", obligatorio).
        * Referencia del pago (Cadena, opcional).
    * Validar que el cliente y proyecto sean obligatorios antes de permitir el registro.
* Listar anticipos:
    * Tabla que muestre anticipos con columnas: Cliente (Cadena), Proyecto (Cadena), Monto (Número), Fecha (Fecha), Método de pago (Cadena).
* Editar anticipos:
    * Seleccionar un anticipo desde la lista y abrir un formulario con los datos prellenados.
* Eliminar anticipos:
    * Botón para eliminar junto a cada anticipo, con confirmación.

### 6. Gestión de Pagos:
* Registrar pago:
    * Formulario con los campos:
        * Seleccionar proveedor (Lista desplegable, obligatorio).
        * Seleccionar proyecto (Lista desplegable, obligatorio).
        * Monto del pago (Número, obligatorio).
        * Fecha del pago (Fecha, obligatorio, formato DD/MM/AAAA).
        * Método de pago (Selección: "Depósito" o "Transferencia", obligatorio).
        * Referencia del pago (Cadena, opcional).
    * Validar que el proveedor y proyecto sean obligatorios.
* Listar pagos:
    * Tabla que muestre los pagos con columnas: Proveedor (Cadena), Proyecto (Cadena), Monto (Número), Fecha (Fecha), Método de pago (Cadena).
* Editar pagos:
    * Seleccionar un pago desde la lista y abrir un formulario con los datos prellenados.
* Eliminar pagos:
    * Botón para eliminar junto a cada pago, con confirmación.

### 7. Gestión de Usuarios:
* Registrar usuario:
    * Formulario con los siguientes campos:
        * Nombre (Cadena, obligatorio).
        * Rol (Selección entre "Administrador" y "Usuario sin privilegios", obligatorio).
        * Email (Cadena, obligatorio, validación de formato).
        * Contraseña (Cadena, obligatorio, mínimo 8 caracteres).
        * Preguntas de seguridad (Cadena, obligatorio).
        * Validar que el correo sea único antes de permitir el registro.
* Listar usuarios:
    * Tabla que muestre los usuarios con columnas: Nombre (Cadena), Rol (Cadena), Email (Cadena).
* Editar usuario:
    * Seleccionar un usuario desde la lista y abrir un formulario con los datos prellenados.
* Eliminar usuario:
    * Botón para eliminar junto a cada usuario, con confirmación (solo los administradores pueden usar esta funcionalidad).
* Restablecer contraseña:
    * Botón de restablecer contraseña que genera una contraseña temporal tras responder la pregunta de seguridad, forzando al usuario a cambiarla en el próximo inicio de sesión.

### Criterios de aceptación específicos:
* No permitir registro de pagos o anticipos sin seleccionar primero un cliente o proveedor, y un proyecto existente.
* Los formularios deben tener validaciones mínimas para evitar entradas incorrectas o incompletas.
* El sistema debe calcular automáticamente los totales de IVA y Subtotal cuando se ingresa un valor en los formularios de proyecto.
* La eliminación de registros debe siempre requerir confirmación por parte del usuario para evitar errores accidentales.

## Requisitos no funcionales:
* El sistema debe desarrollarse con el framework de Laravel 11
* Validación básica:
    * Todos los formularios deben tener validaciones básicas (campos obligatorios, formato de email, etc.).
* Diseño básico:
    * El sistema debe usar estilos sencillos de Bootstrap para mejorar la interfaz de usuario.
* Pagos y anticipos listados:
    * Las listas de pagos y anticipos deben estar paginadas para evitar la sobrecarga visual.
