## Configuración y Construcción del Contenedor Docker

Sigue estos pasos para configurar, construir y ejecutar el contenedor Docker para la API de Laravel.

### Configuración del Contenedor

1. **Asegúrate de tener Docker y Docker Compose instalados** en tu máquina. Puedes encontrar las instrucciones de instalación en la [documentación oficial de Docker](https://docs.docker.com/get-docker/) y [Docker Compose](https://docs.docker.com/compose/install/).

2. **Clona el repositorio del proyecto** (si no lo has hecho ya):
   ```bash
   git clone https://github.com/Alexander1251/Investigacion_2
   cd Investigacion_2
   ```
3. **Utiliza el siguiente comando**
   ```bash
   docker-compose up --build
   ```
   El contenedor ya estara listo para ser usado, puedes dirigirte a http://localhost:8000/ y veras el template de laravel.

### Testeo
Desde [postman](https://web.postman.co/) podemos realizar las diversas pruebas, un ejemplo de ello es realizar una nueva peticion GET a http://localhost:8000/api/jugadores/index

Debe devolver esto:
```bash
   {
    "message": "Lista de jugadores",
    "data": [
        {
            "id": 1,
            "nombres": "Alfredo",
            "apellidos": "Perez",
            "sexo": "Masculino",
            "edad": 18,
            "id_equipo": 1
        }
    ]
   }
   ```
