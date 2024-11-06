# Funcionalidades generales del sistema

## Requisitos Funcionales:

### 1. Autenticación de usuarios:
* El sistema debe mostrar un formulario de inicio de sesión con dos campos:
    * Correo electrónico.
    * Contraseña.
* El formulario debe tener un botón de "Iniciar sesión" que valide los datos ingresados contra los usuarios registrados.
* Si los datos no son válidos, mostrar un mensaje de error.
* Implementar validación simple de formato para el correo electrónico (e.g., contiene "@" y un dominio).

### 2. Gestión de Proyectos:
* Agregar proyecto:
    * Formulario con los siguientes campos:
        * Nombre del proyecto (campo obligatorio).
        * Fecha de inicio (campo obligatorio, formato DD/MM/AAAA).
        * Subtotal (número, obligatorio).
        * IVA (número, opcional, puede calcularse automáticamente a partir del subtotal).
        * Total (número, obligatorio, calculado a partir de subtotal + IVA).
        * Concepto (texto, opcional).
        * Comentarios adicionales (texto, opcional).
    * Validar que el nombre y la fecha de inicio sean obligatorios antes de permitir el guardado.
* Listar proyectos:
    * Tabla que muestra los proyectos con las columnas: Nombre, Fecha de inicio, Total.
    * Opción para filtrar proyectos por estado (activo/inactivo).
* Editar proyecto:
    * Seleccionar un proyecto desde la lista y abrir el formulario con los datos prellenados.
* Eliminar proyecto:
    * Botón de eliminar junto a cada proyecto que lo elimine tras una confirmación.

### 3. Gestión de Clientes:
* Agregar cliente:
    * Formulario con los siguientes campos:
        * Razón social (obligatorio).
        * Tipo (Persona Física o Moral) (obligatorio, con opción seleccionable).
        * RFC (obligatorio, formato simple de validación: al menos 12 caracteres alfanuméricos).
        * Domicilio fiscal (opcional).
        * Email (obligatorio, con validación de formato).
        * Teléfono (opcional).
    * Validar que el RFC y el correo sean únicos al registrar un nuevo cliente.
* Listar clientes:
    * Tabla que muestre los clientes con columnas: Razón social, RFC, Email, Teléfono.
* Editar cliente:
    * Seleccionar un cliente desde la lista y abrir un formulario con los datos prellenados.
* Eliminar cliente:
    * Botón para eliminar junto a cada cliente, con confirmación.

### 4. Gestión de Proveedores:
* Agregar proveedor:
    * Campos idénticos a los de clientes.
    * Validar que el RFC y el correo sean únicos al registrar.
* Listar proveedores:
    * Similar a la funcionalidad de clientes.
* Editar y eliminar proveedores:
    * Mismas funcionalidades que para clientes.

### 5. Gestión de Anticipos:
* Registrar anticipo:
    * Formulario con los campos:
        * Seleccionar cliente (lista desplegable con clientes registrados).
        * Seleccionar proyecto (lista desplegable con proyectos activos).
        * Monto del anticipo (obligatorio, numérico).
        * Fecha del anticipo (obligatorio, formato DD/MM/AAAA).
        * Método de pago (selección: Depósito o Transferencia).
        * Referencia del pago (texto, opcional).
    * Validar que el cliente y proyecto sean obligatorios antes de permitir el registro.
* Listar anticipos:
    * Tabla que muestre anticipos con columnas: Cliente, Proyecto, Monto, Fecha, Método de pago.
* Editar y eliminar anticipos:
    * Funcionalidades similares a las de proyectos y clientes.

### 6. Gestión de Pagos:
* Registrar pago:
    * Formulario con los campos:
        * Seleccionar proveedor (lista desplegable).
        * Seleccionar proyecto (lista desplegable).
        * Monto del pago (obligatorio, numérico).
        * Fecha del pago (obligatorio, formato DD/MM/AAAA).
        * Método de pago (selección: Depósito o Transferencia).
        * Referencia del pago (texto, opcional).
    * Validar que el proveedor y proyecto sean obligatorios.
* Listar pagos:
    * Tabla que muestre los pagos con columnas: Proveedor, Proyecto, Monto, Fecha, Método de pago.
* Editar y eliminar pagos:
* Funcionalidades similares a las de anticipos.

### 7. Gestión de Usuarios:
* Registrar usuario:
    * Formulario con los siguientes campos:
        * Nombre (obligatorio).
        * Rol (selección entre Administrador y Usuario sin privilegios).
        * Email (obligatorio, validación de formato).
        * Contraseña (obligatoria).
        * Validar que el correo sea único antes de permitir el registro.
* Listar usuarios:
    * Tabla que muestre los usuarios con columnas: Nombre, Rol, Email.
* Editar usuario:
    * Similar a las otras secciones, se puede editar nombre, rol y correo electrónico.
* Restablecer contraseña:
    * Botón de restablecer contraseña que genera una contraseña temporal y fuerza al usuario a cambiarla en el próximo inicio de sesión.

### Criterios de aceptación específicos:
* No permitir registro de pagos o anticipos sin seleccionar primero un cliente o proveedor, y un proyecto existente.
* Los formularios deben tener validaciones mínimas para evitar entradas incorrectas o incompletas.
* El sistema debe calcular automáticamente los totales de IVA y Subtotal cuando se ingresa un valor en los formularios de proyecto.
* La eliminación de registros debe siempre requerir confirmación por parte del usuario para evitar errores accidentales.

## Requisitos no funcionales:
* Validación básica:
    * Todos los formularios deben tener validaciones básicas (campos obligatorios, formato de email, etc.).
* Diseño básico:
    * El sistema debe usar estilos sencillos de Bootstrap para mejorar la interfaz de usuario.
* Pagos y anticipos listados:
    * Las listas de pagos y anticipos deben estar paginadas para evitar la sobrecarga visual.