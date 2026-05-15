# Sistema de Trazabilidad y Control de Alimentos

Este es un proyecto de grado desarrollado con **Laravel 11** para la gestión automatizada de inventarios de alimentos, enfocado en el control de lotes y alertas de vencimiento mediante un sistema de semaforización.

##  Avance Actual: Fase 2 (Backend & Base de Datos)
Actualmente, el sistema cuenta con:
* **Conexión exitosa a MySQL** mediante Laragon/Workbench.
* **Modelado de Datos:** Tablas de `productos` y `lotes` con relaciones de integridad.
* **Dashboard Dinámico:** Visualización en tiempo real de los datos almacenados.
* **Lógica de Semáforo:** Clasificación automática de estados (Óptimo, Por Vencer, Vencido).

##  Tecnologías Utilizadas
* **Framework:** [Laravel 11](https://laravel.com/)
* **Base de Datos:** MySQL (Workbench)
* **Servidor Local:** Laragon
* **Frontend:** Blade Templates & Bootstrap 5
* **Lenguaje:** PHP 8.2+

##  Estructura de la Base de Datos
El sistema utiliza un esquema relacional donde un **Producto** puede tener múltiples **Lotes**. Cada lote contiene:
* Código único de trazabilidad.
* Fecha de producción y vencimiento.
* Cantidad y estado actual.
