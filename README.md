# Wanup Workshop redis

# Mostrando los últimos items agregados (live cache)

Tenemos una aplicación web donde queremos mostrar los últimos 20 hoteles dados de alta.

__Tarea__: Implementar una estructura que permita tener index los items por
la primera letra del título.

# Contadores

Queremos mantener un contador de las veces que se ha hecho "click" sobre 
cada item.

Podríamos simplemente agregar una columna más a la tabla de items, pero en casos
de gran concurrencia, esto no es para nada óptimo. Necesitamos algo más rápido
que bloquear-leer-incrementar-escribir.

__Tarea__: Crear las estructuras que permitan contar la cantidad de clicks 
globales, por semana, y por día.

__Tarea__: Mostrar un listado con los items más populares en los últimos 7 días 
y en las últimas 24 horas.


# Favoritos

Tenemos usuarios, queremos que los usuarios puedan mantener un listado de sus
hoteles favoritos.

__Tarea__: Implementar las estructuras necesarias para mantener un listado de
los hoteles favoritos de cada usuario.

__Tarea:__: Mostrar un listado de los hoteles favoritos que tienen en común varios
usuarios.

# Leaderboards (tablas de clasificación)

El ejemplo clásico es la tabla de clasificación de un juego.
Por ejemplo, hagamos un juego a ver cuales son los usuarios que más items han
recomendando.

Tened en cuenta que podemos tener varios miles de recomendaciones por minuto

__Tarea__: Mostrar una tabla de clasificación con los mejores 100 usuarios.
__Tarea__: Mostrar al usuario su rango global actual.

Nota: Estas implementaciones son triviales en Redis, incluso si se tienen
millones de usuarios y millones de nuevas recomendaciones por minuto.

# Items únicos

Otro ejemplo interesante que es relativamente fácil de implementar con Redis, 
pero posiblemente muy difícil con otro tipo de bases de datos, es la problemática
de ver cuántos usuarios únicos visitaron un recurso determinado en una determinada
cantidad de tiempo. 

Por ejemplo, queremos conocer el número de usuarios únicos, que han accedido a 
un determinado item.

__Tarea__: Implementar las estructuras necesarias para llevar la estadística de
cuáles son los usuarios que han (visitado, comprado, recomendado) cierto item en
las últimos (5 mins, 1 hora, 6 horas, 24 horas, 7 días, etc...)

# Lista circular

Su super sistema de predicciones ha determinado cuales son los items que más le
pueden interesar a cierto usuario. Queremos mostar al usuario esos items, de uno
en uno (de tal forma que no sea agobiante para el usuario).

__Tarea__: Implementar estructura que permita mostar un banner rotativo con items
recomendados, un item a la vez.

# Lua scripts

borrar por pattern:
```bash
EVAL "return redis.call('del', unpack(redis.call('keys', ARGV[1])))" 0 users:1:*
```


