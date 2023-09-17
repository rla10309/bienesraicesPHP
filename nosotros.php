<?php
require "includes/funciones.php";
incluirTemplate("header");
?>


<main class="contenedor seccion">
  <h1>Conoce sobre Nosotros</h1>
  <div class="contenido-nosotros">
    <div class="imagen">
      <picture>
        <source srcset="build/img/nosotros.webp" type="image/webp" />
        <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
        <img src="build/img/nosotros.jpg" alt="Sobre nosotros" loading="lazy" />
      </picture>
    </div>
    <div class="texto-nosotros">
      <blockquote>25 Años de Experiencia</blockquote>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi
        suscipit ipsa inventore, facilis iste asperiores aliquam facere?
        Incidunt eum, hic ullam ut beatae at rerum odio, voluptates enim
        corrupti animi explicabo. Qui unde perferendis sint obcaecati itaque
        nulla ut perspiciatis aperiam vitae fugit illo quam, impedit
        officiis harum nesciunt facere adipisci numquam? Cumque, saepe
        minus? Qui porro atque nemo, aspernatur recusandae officiis at id.
        Assumenda quae neque id, cumque, odit, pariatur aut alias maiores ad
        ducimus esse unde officia doloribus consectetur earum quibusdam?
        Eligendi expedita at impedit animi quo totam cum hic blanditiis,
        natus exercitationem aliquid omnis odio inventore excepturi.
      </p>
      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestias
        vel qui neque culpa ullam reiciendis quae eveniet dolorem, possimus
        assumenda pariatur tempora consequatur vero optio nemo vitae
        mollitia quas cupiditate eaque sunt exercitationem soluta placeat
        quis officia! Eligendi pariatur nobis vero voluptate, reiciendis,
        maiores quasi sint illo, numquam fuga quisquam quae! Amet doloribus,
        temporibus quas id suscipit voluptates veniam incidunt odio
        perspiciatis corrupti earum provident iusto molestias, corporis
        sapiente voluptatibus!
      </p>
    </div>
  </div>
  <section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
      <div class="icono">
        <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy" />
        <h3>Seguridad</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Molestias enim debitis nihil minima labore praesentium,
          consequuntur accusantium provident amet qui ullam nostrum
          adipisci, a alias rerum eligendi veniam doloribus voluptate.
        </p>
      </div>
      <div class="icono">
        <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy" />
        <h3>Precio</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Molestias enim debitis nihil minima labore praesentium,
          consequuntur accusantium provident amet qui ullam nostrum
          adipisci, a alias rerum eligendi veniam doloribus voluptate.
        </p>
      </div>
      <div class="icono">
        <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy" />
        <h3>A Tiempo</h3>
        <p>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit.
          Molestias enim debitis nihil minima labore praesentium,
          consequuntur accusantium provident amet qui ullam nostrum
          adipisci, a alias rerum eligendi veniam doloribus voluptate.
        </p>
      </div>
    </div>
  </section>
</main>
<?php
incluirTemplate("footer");
?>