<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Gestoría Online</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7fa;
      color: #2c3e50;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #1a237e;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .logo {
      font-size: 2rem;
      font-weight: bold;
    }
    .menu {
      list-style: none;
      padding: 0;
      margin: 15px 0 0;
      display: flex;
      justify-content: center;
      gap: 25px;
    }
    .menu li a {
      color: white;
      text-decoration: none;
      font-weight: 500;
    }
    main {
      padding: 40px 20px;
    }
    section {
      margin-bottom: 50px;
    }
    .grid-servicios {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    .servicio {
      background-color: #e3eaf5;
      padding: 20px;
      border-radius: 10px;
    }
    button {
      background-color: #1565c0;
      color: white;
      padding: 10px;
      margin-top: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0d47a1;
    }
    .info-detallada {
      margin-top: 10px;
      background-color: #dbe6f2;
      padding: 10px;
      border-radius: 6px;
      display: none;
    }
    #cita {
      background: linear-gradient(135deg, #ffffff, #e6f0ff);
      padding: 40px;
      border-radius: 16px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    .formulario-cita {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .formulario-cita input,
    .formulario-cita textarea {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }
    .formulario-cita textarea {
      grid-column: span 2;
      min-height: 100px;
    }
    .formulario-cita input[type="submit"] {
      background-color: #00aaff;
      color: white;
      font-weight: bold;
      grid-column: span 2;
      cursor: pointer;
      border: none;
    }
    .formulario-cita input[type="submit"]:hover {
      background-color: #008ecc;
    }
    footer {
      background-color: #1a237e;
      color: white;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>

<header>
  <div class="logo">Gestoría Online</div>
  <nav>
    <ul class="menu">
      <li><a href="#servicios">Servicios</a></li>
      <li><a href="#nosotros">Nosotros</a></li>
      <li><a href="#contacto">Contacto</a></li>
      <li><a href="#cita">Cita</a></li>
      <li><a href="login.php">Iniciar sesión</a></li>
      <li><a href="registro.php">Registrarse</a></li>
    </ul>
  </nav>
</header>

<main>
<section id="servicios">
  <h2>Servicios</h2>
  <div class="grid-servicios">

    <div class="servicio">
      <h3>Asesoría Fiscal</h3>
      <p>Gestión de IVA, IRPF y modelos trimestrales.</p>
      <button onclick="toggleInfo('info-fiscal')">ℹ️ Más info</button>
      <button onclick="location.href='#cita'">📩 Solicitar este servicio</button>
      <div class="info-detallada" id="info-fiscal">
        Incluye declaraciones de impuestos, modelos 130/303, asesoramiento para reducir la carga fiscal legalmente.
      </div>
    </div>

    <div class="servicio">
      <h3>Asesoría Laboral</h3>
      <p>Contratos, nóminas y seguros sociales.</p>
      <button onclick="toggleInfo('info-laboral')">ℹ️ Más info</button>
      <button onclick="location.href='#cita'">📩 Solicitar este servicio</button>
      <div class="info-detallada" id="info-laboral">
        Redacción de contratos, gestión de bajas, altas, cotizaciones, convenios colectivos y despidos.
      </div>
    </div>

    <div class="servicio">
      <h3>Contabilidad</h3>
      <p>Gestión contable de tu empresa.</p>
      <button onclick="toggleInfo('info-conta')">ℹ️ Más info</button>
      <button onclick="location.href='#cita'">📩 Solicitar este servicio</button>
      <div class="info-detallada" id="info-conta">
        Registros contables, libros oficiales, balances, presentación de cuentas anuales.
      </div>
    </div>

    <div class="servicio">
      <h3>Autónomos</h3>
      <p>Tramitación completa y asesoramiento.</p>
      <button onclick="toggleInfo('info-auto')">ℹ️ Más info</button>
      <button onclick="location.href='#cita'">📩 Solicitar este servicio</button>
      <div class="info-detallada" id="info-auto">
        Alta RETA, libros de ingresos/gastos, IRPF, IVA, modelos trimestrales y guía personalizada.
      </div>
    </div>

    <div class="servicio">
      <h3>Trámites Administrativos</h3>
      <p>Gestión integral de trámites oficiales.</p>
      <button onclick="toggleInfo('info-tramites')">ℹ️ Más info</button>
      <button onclick="location.href='#cita'">📩 Solicitar este servicio</button>
      <div class="info-detallada" id="info-tramites">
        Certificados, herencias, NIE, extranjería, tráfico, poderes notariales y escrituras.
      </div>
    </div>

  </div>
</section>

<section id="nosotros">
  <h2>¿Quiénes somos?</h2>
  <div class="grid-servicios">
    <div class="servicio">
      <h3>+15 años de experiencia</h3>
      <p>Somos una gestoría con más de 15 años ayudando a autónomos, pymes y particulares a cumplir con sus obligaciones fiscales, laborales y administrativas.</p>
    </div>
    <div class="servicio">
      <h3>Equipo profesional</h3>
      <p>Nuestro equipo está formado por asesores fiscales, laborales y contables colegiados, con trato cercano y soluciones adaptadas a cada cliente.</p>
    </div>
    <div class="servicio">
      <h3>Compromiso y transparencia</h3>
      <p>Nos esforzamos por ofrecer una atención personalizada, transparente y enfocada en resolver tus necesidades con rapidez y claridad.</p>
    </div>
  </div>
</section>


<section id="faq">
  <h2>Preguntas frecuentes</h2>
  <div class="grid-servicios">
    <div class="servicio">
      <h4>¿Puedo contratar solo un servicio puntual?</h4>
      <p>Sí, ofrecemos servicios tanto por suscripción mensual como por encargo puntual.</p>
    </div>
    <div class="servicio">
      <h4>¿Atienden a empresas y autónomos?</h4>
      <p>Sí, trabajamos con ambos perfiles. También asesoramos a particulares en trámites fiscales y laborales.</p>
    </div>
    <div class="servicio">
      <h4>¿Cómo agendo una cita?</h4>
      <p>Rellena el formulario en la sección “Solicita tu cita” y nos pondremos en contacto contigo.</p>
    </div>
  </div>
</section>

<section id="contacto">
  <h2>Contacto</h2>
  <p>📍 Dirección: Calle Ejemplo 123, Ciudad</p>
  <p>📞 Teléfono: 123 456 789</p>
  <p>📧 Email: contacto@gestoria.com</p>
</section>

<section id="cita">
  <h2>📅 Solicita tu cita</h2>
  <div class="formulario-cita">
    <form action="https://formsubmit.co/alumno006pruebas006@gmail.com" method="POST">
      <input type="text" name="nombre" placeholder="Nombre completo" required>
      <input type="email" name="correo" placeholder="Correo electrónico" required>
      <input type="date" name="fecha" required>
      <select name="motivo" required>
  <option value="">Selecciona un motivo</option>
  <option value="Asesoría Fiscal">Asesoría Fiscal</option>
  <option value="Asesoría Laboral">Asesoría Laboral</option>
  <option value="Contabilidad">Contabilidad</option>
  <option value="Alta Autónomos o Empresas">Alta de Autónomos o Empresas</option>
  <option value="Declaración de la Renta">Declaración de la Renta</option>
  <option value="Trámites Administrativos">Trámites Administrativos</option>
  <option value="Consulta general">Consulta general</option>
</select>

<textarea name="comentarios" placeholder="Comentarios adicionales (opcional)"></textarea>
      <!-- Configuración adicional -->
      <input type="hidden" name="_next" value="https://gestoria.great-site.net//confirmacion.html">
      <input type="hidden" name="_captcha" value="false">

      <input type="submit" value="Enviar solicitud">
    </form>
  </div>
</section>

</main>

<footer>
  <p>&copy; 2025 Gestoría Online — Todos los derechos reservados.</p>
</footer>

<script>
  function toggleInfo(id) {
    const elem = document.getElementById(id);
    elem.style.display = elem.style.display === 'block' ? 'none' : 'block';
  }
</script>

</body>
</html>
