<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto">
    <link rel="stylesheet" href="/gestao_escolar/css/index_style.css">
    <title>Gestão Escolar</title>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Gestão Escolar</div>
        <div class="menu">
            <a href="#about">Sobre a Escola</a>
            <a href="#courses">Cursos</a>
            <a href="#testimonials">Depoimentos</a>
            <a href="/gestao_escolar/public/login.php">Login</a>
        </div>
    </nav>

    <!-- Sobre a Escola -->
    <section id="about" class="section about-school">
        <h2>Sobre a Escola</h2>
        <p>
            Nossa escola é referência em formação tecnológica, oferecendo cursos de alta qualidade para formar
            profissionais prontos para o mercado de trabalho. Conecte-se conosco através das nossas redes sociais.
        </p>
        <div class="section-social-links">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </section>

    <!-- Cursos -->
    <section id="courses" class="section courses">
        <h2>Nossos Cursos</h2>
        <p>
            Oferecemos cursos de formação fullstack para você se tornar um desenvolvedor completo. Confira nossas
            opções:
        </p>
        <div class="course-cards">
            <div class="course-card">
                <h3>PHP e Laravel</h3>
                <p>Domine o backend com PHP e o framework Laravel.</p>
            </div>
            <div class="course-card">
                <h3>JavaScript e React</h3>
                <p>Aprenda a criar interfaces modernas com React.</p>
            </div>
            <div class="course-card">
                <h3>Java</h3>
                <p>Desenvolva aplicações robustas com Java.</p>
            </div>
            <div class="course-card">
                <h3>C#</h3>
                <p>Crie soluções empresariais com C# e .NET.</p>
            </div>
        </div>
    </section>

    <!-- Depoimentos -->
    <section id="testimonials" class="section testimonials">
        <h2>O que nossos alunos dizem</h2>
        <div class="testimonial-cards">
            <div class="testimonial-card">
                <p>"O curso de PHP e Laravel mudou minha carreira. Recomendo!"</p>
                <span>— João Silva</span>
            </div>
            <div class="testimonial-card">
                <p>"Aprendi React de forma prática e rápida. Excelente didática!"</p>
                <span>— Maria Souza</span>
            </div>
            <div class="testimonial-card">
                <p>"Java me abriu portas para grandes oportunidades. Gratidão!"</p>
                <span>— Carlos Oliveira</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Gestão Escolar. Todos os direitos reservados.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
    </footer>
</body>

</html>