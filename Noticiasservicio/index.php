<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>JCRS - </title>
    </head>
    <body>
        <?php
        include 'Conexion.php';

        function selectCategoria() {
            $conexion = Conexion::conectar();
            $resultado = $conexion->query("SELECT * FROM categorias");
            if ($resultado) {

                echo"<select name='categoria' id='categorias'>";

                while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value = '" . $row["nombre"] . "' id='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }

                echo "</select>";
            }

            unset($conexion);
        }
        ?>
        <script>
            function funcion(e) {
                var categoria = document.getElementById("categorias");
                var parametros = {
                    "categoria": categoria.options[categoria.selectedIndex].id,

                    "fecha": document.querySelector("#fecha").value
                };
                var ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var arrayNoticias = JSON.parse(this.responseText);

                        for (var noticia of arrayNoticias) {
                            var fila = document.createElement("tr");
                            fila.appendChild(crearNodoYTexto("td", noticia.id));
                            fila.appendChild(crearNodoYTexto("td", noticia.titulo));
                            fila.appendChild(crearNodoYTexto("td", noticia.contenido));
                            fila.appendChild(crearNodoYTexto("td", noticia.fecha));
                            fila.appendChild(crearNodoYTexto("td", noticia.categoria));

                            document.querySelector("#destino").appendChild(fila);
                        }

                    }
                }

                ajax.open("POST", "peticion.php", true);
                ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                ajax.send("json=" + JSON.stringify(parametros));
            }

            function crearNodoYTexto(nodo, text) {
                var nodo = document.createElement(nodo);
                var texto = document.createTextNode(text);
                nodo.appendChild(texto);
                return nodo;
            }
        </script>

        <div>
            <p>
                <label for="Categoria">Categoria</label>
                <?php selectCategoria() ?>
            </p>

            <p>
                <label for="fecha">Fecha</label>
                <input type="text" id="fecha" name="fecha" value="0000-00-00 00:00:00" />
            </p>
            <button onclick="funcion()">Enviar</button>
            <!--</form>-->
        </div>

        <div >
            <table>
                <tr>
                    <th>id</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Fecha</th>
                    <th>Categoría</th>
                </tr>
                <tbody id="destino">

                </tbody>

            </table>
        </div>

    </body>


</html>
