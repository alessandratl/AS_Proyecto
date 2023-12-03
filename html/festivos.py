import holidays

def obtener_fechas_festivas(year):
    try:
        festivos_espana = holidays.Spain(years=year)
        return festivos_espana
    except Exception as e:
        print(f"Error al obtener las fechas festivas: {str(e)}")
        return None

festivos_2024 = obtener_fechas_festivas(2024)
if festivos_2024:
    with open('festivos_2024.txt', 'w') as archivo:
        archivo.write("Fechas festivas en España en 2024:\n")
        for fecha, nombre in festivos_2024.items():
            linea = f"- {fecha}: {nombre}\n"
            archivo.write(linea)
    print("Información guardada en festivos_2024.txt")
else:
    print("No se pudo obtener la información de los festivos.")

def crear_html_con_estilo(nombre_fichero):
    # Contenido del archivo HTML
    contenido_html = f'''
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Festivos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor"> 
    <div class="col2"> 
    <h2>Tabla de Festivos</h2>
    
    <table border="1">
        <tr><th>Fecha</th><th>Nombre</th></tr>
'''

    # Leer el contenido del archivo de festivos
    with open(nombre_fichero, 'r', encoding='utf-8') as archivo:
        lineas = archivo.readlines()

    # Agregar cada línea del archivo como una fila en la tabla HTML
    for linea in lineas:
        campos = linea.strip().split(':')
        fecha = campos[0]
        nombre = ':'.join(campos[1:])
        contenido_html += f'<tr><td>{fecha}</td><td>{nombre}</td></tr>\n'

    # Cerrar la estructura del HTML
    contenido_html += '''
	
    </table>

    <button type="button" onclick="redirectToLogin()">Salir</button>
    <script>
        function redirectToLogin() {
            // Redirige a la página de registro
            window.location.href = "index.html";
        }    
    </script>
   

</body>
</html>
'''

    # Guardar el contenido en un archivo HTML
    with open('Festivos.html', 'w', encoding='utf-8') as html_file:
        html_file.write(contenido_html)

# Llamar a la función para crear el archivo HTML con el estilo CSS
crear_html_con_estilo('festivos_2024.txt')

