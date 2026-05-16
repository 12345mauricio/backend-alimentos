# Sistema Inteligente de Gestión de Calidad y Trazabilidad de Alimentos

## Descripción del Proyecto
El presente proyecto consiste en el desarrollo de un sistema web inteligente orientado a la gestión de calidad y trazabilidad de alimentos, enfocado en el control de lotes, fechas de vencimiento, inventarios y reducción de pérdidas dentro de empresas del sector alimentario.

El sistema busca modernizar los procesos tradicionales de control de productos alimentarios mediante herramientas tecnológicas que permitan registrar, organizar, monitorear y rastrear la información relacionada con productos, lotes y movimientos de inventario.

La plataforma permitirá mejorar el control interno de las empresas mediante el uso de registros digitales, alertas automáticas de vencimiento y seguimiento de productos a través de lotes, facilitando así la trazabilidad alimentaria y el cumplimiento de normativas sanitarias.

Además, el sistema contribuirá a reducir pérdidas económicas ocasionadas por productos vencidos, errores en inventarios y deficiencias en el control manual de información.

## Arquitectura del Sistema
El sistema estará basado en una arquitectura de tres capas:

### 1. Capa de Presentación
Corresponde a la interfaz web con la que interactúan los usuarios del sistema. Permitirá realizar operaciones como:
* Inicio de sesión
* Registro de productos
* Gestión de lotes
* Visualización de alertas
* Consulta de inventarios
* Generación de reportes

La interfaz será intuitiva, responsiva y accesible desde navegadores web modernos.

### 2. Capa Lógica o de Negocio
Es la encargada de procesar toda la lógica del sistema. Dentro de esta capa se implementarán funcionalidades como:
* Validación de usuarios
* Gestión de productos y lotes
* Control de inventarios
* Registro de movimientos
* Generación de alertas automáticas
* Procesamiento de trazabilidad
* Generación de reportes

Esta capa permitirá automatizar los procesos de control y monitoreo de productos alimentarios.

### 3. Capa de Datos
Corresponde a la base de datos del sistema. Aquí se almacenará toda la información relacionada con:
* Usuarios
* Productos
* Lotes
* Inventarios
* Movimientos
* Alertas
* Reportes

La base de datos permitirá mantener integridad, seguridad y trazabilidad de la información.

## 🛠️ Tecnologías Utilizadas
* **Framework:** Laravel 11
* **Base de Datos:** MySQL (Workbench)
* **Servidor Local:** Laragon
* **Frontend:** Blade Templates & Bootstrap 5
* **Lenguaje:** PHP 8.2+