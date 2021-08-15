# Alquilibros
## Problema

### Se requiere un sistema para una tienda de alquiler de Libros y DVDs.

Los dos casos de usuario son Prestar y Devolver.

Los libros cuestan 3,5 € y los DVDs 5 €.

Existen dos tipos de personas que pueden alquilar , los usuarios y los trabajadores. Los trabajadores tienen **un
10% de descuento**.

* Los libros y DVDs no se podrán prestar si ya están prestados.
* Los que alquilan no podrán alquilar si ya tienen un alquiler.

Por cuestiones legales.

Los libros y DVDs tienen un rango de edad con el que se pueden alquilar. Los libros y dvs solo los pueden alquilar
las personas con la edad recomendada:

* Categoría Niños, solo usuarios de 0 a 12 años **(cambiado a *niño*)**
* Categoría Jóvenes de 13 a 17 **(cambiado a *joven*)**
* Categoría Adultos de 18 o más **(cambiado a *adulto*)**
* **Categoría *todos* para cualquier edad**

**nota: Un adulto no puede alquilar un libro de niños**

## Solución

### Sencilla
En este caso, la mayor parte del programa se ha planteado como una librería de uso genérico, pero se han hecho algunas modificaciones para simplificar el ejemplo pedido en la prueba.

La clase *Alquilibros* puede añadir, alquilar, devolver y mostrar la lista de libros y DVDs. También puede añadir y mostrar empleados (usuarios con 10% de descuento).

### Ejemplo de Uso
```
  $alquilibro  = new Alquilibros();
  $user1 = new User("Pepe Reina",14);
  $alquilibro->addEmployee($user1);
  $alquilibro->addBook("Peter Pan","joven");


  $alquilibro->reserveBook("Peter Pan",$user1);
  $alquilibro->unreserveBook("Peter Pan",$user1);

  $alquilibro->reserveDvd("Peter Pan",$user1);
  $alquilibro->unreserveDvd("Peter Pan",$user1);
  ```
### Resultado de ejecución
```
  El usuario se ha registrado como empleado.
  El libro 'Peter Pan' ha sido añadido con éxito.
  El DVD 'Peter Pan' ha sido añadido con éxito.
  El libro 'Peter Pan' ha sido reservado por Pepe Reina con éxito.
  El precio del alquiler es de 2.70€.
  El libro 'Peter Pan' ha sido devuelto por Pepe Reina con éxito.
  El DVD 'Peter Pan' ha sido reservado por Pepe Reina con éxito.
  El precio del alquiler es de 4.50€.
  El DVD 'Peter Pan' ha sido devuelto por Pepe Reina con éxito.
  
  ```
### Interactiva

En esta versión se pueden utilizar todas las funcionalidades de la librería por consola. 

La clase Interactive hereda de Alquilibros y añade las funcionalidades interactivas. 

Para poder probar la versión interactiva, basta con llamar al método **menu** de la clase interactive (ejemplo en el archivo testInteractive.php).

#### Resultado de ejecución de testInteractive.php

```
-----------------Alquilibros-----------------
Bienvenido a Alquilibros, ¿qué deseas hacer?
0: Añadir usuario
1: Registrarse como empleado
2: Añadir libro / DVD
3: Reservar libro / DVD 
4: Devolver reserva
5: salir

```


  
