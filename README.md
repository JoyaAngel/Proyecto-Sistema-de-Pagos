## Proyecto-Implementación

###Descripción

Como administrador quiero ingresar al sistema por medio de usuario y contraseña, para
poder agregar, eliminar, actualizar y listar los pagos que obtiene y que realiza una empresa
de desarrollo de software.

###Descripción:

Quiero registrar los datos para administrar los pagos y anticipos por proyecto activo que me
servirá para llevar un control de los pagos que se realizan a los proveedores y los anticipos
que los clientes realizan, así como administrar proyectos, mismos a los cuáles se le registrarán
esos pagos y anticipos.

Los campos que se deberán registrar son los siguientes:

1. Proyectos:
  * Nombre
  * Fecha de Inicio del Proyecto
  * Subtotal
  * IVA
  * Total
  * Concepto
  * Comentarios Adicionales

2. Clientes:
  * Razón Social
  * Persona Física o Moral
  * RFC
  * Domicilio Fiscal
  * Email
  * Teléfono

3. Proveedores
  * Razón Social:
  * Persona Física o Moral
  * RFC
  * Domicilio
  * Email
  * Teléfono

4. Anticipos:
  * Cliente quien realizó el anticipo
  * Proyecto al que pertenece este anticipo
  * Monto del anticipo
  * Fecha del Anticipo
  * Método (Deposito o Transferencia)
  * Referencia

5. Pagos:
  * Proveedor al que se le realizó el pago
  * Proyecto al que pertenece este pago
  * Monto del pago
  * Fecha del pago
  * Método (Deposito o Transferencia)
  * Referencia

6. Usuarios:
  * Nombre del Usuario
  * Rol (Administrador o Usuario sin Privilegios)
  * Email
  * Password

###Criterios Aceptación:

En caso de que el administrador desee registrar un pago o anticipo primero deberá listar los
proyectos activos y si el proyecto existe podrá continuar con el registro, en caso contrario
deberá antes registrar el proyecto.

En caso de que el administrador desee registrar un proyecto se deberá llevar el control de la
cantidad de dinero por pagar del cliente y la cantidad de dinero a pagar a los proveedores.
En caso de que el administrador desee registrar un pago o anticipo el sistema deberá de
llevar el control del dinero restante por pagar del cliente y el dinero restante por pagar a los
proveedores.

Si el administrador desea registrar un usuario sin privilegios u otro administrador únicamente
deberá solicitar el nombre, apellidos, correo electrónico, usuario y contraseña.

Si el administrador requiere cambiar la contraseña de un usuario, el sistema deberá tener la
opción de restablecer la contraseña, cuando el administrador seleccione dicha opción, el
sistema deberá asignar una contraseña temporal y deberá solicitar en su próximo acceso que
cambie de contraseña.

**Nota:** Otros detalles se explicarán en el salón de clases y que esos detalles también
formarán parte de los criterios de aceptación.

###Criterios de Evaluación

Elaborar un sistema con ayuda del Framework Laravel, de acuerdo a las instrucciones del
sistema antes mencionadas y en equipo de 6 personas. Tu proyecto desarrollado con
laravel deberá incluir migrations de la base de datos, controladores de tipo resource y el
consumo a la base de datos por medio de la capa ORM. Aplicar reglas de validación, Layouts,
paginadores y estilos Bootstrap, etc.

El proyecto debe de incluir las siguientes fases del ciclo de desarrollo de software:
* Análisis
* Diseño
* Desarrollo
* Implementación

Finalmente se deberá realizar la exposición del proyecto, en donde todos los integrantes
deberán participar. El objetivo de la exposición es mostrar la documentación realizada, la
ejecución, la arquitectura del sistema (para observar que todo lo trabajado en el semestre fue
aplicado en el proyecto) y finalmente corroborar los criterios de aceptación.

El profesor asignará la fecha en que toque a tu equipo presentar la exposición
