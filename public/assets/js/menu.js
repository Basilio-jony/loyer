document.addEventListener("DOMContentLoaded", function () {
    const menu = document.getElementById("sidebar");
    const openBtn = document.getElementById("open-menu");
    const closeBtn = document.getElementById("close-menu");

    // Abre o menu
    openBtn.addEventListener("click", function () {
        menu.style.left = "0";
        openBtn.style.display = "none";
        closeBtn.style.display = "block";
    });

    // Fecha o menu
    closeBtn.addEventListener("click", function () {
        menu.style.left = "-250px";
        openBtn.style.display = "block";
        closeBtn.style.display = "none";
    });

    // Garante que o botão de fechar está oculto no início
    closeBtn.style.display = "none";

    // Adiciona rolagem suave ao clicar nos links do menu
    document.querySelectorAll("#sidebar a").forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const offsetTop = targetElement.getBoundingClientRect().top + window.scrollY;

                window.scrollTo({
                    top: offsetTop - 50, // Ajusta para deixar espaço no topo
                    behavior: "smooth"
                });

                // Fecha o menu após clicar
                menu.style.left = "-250px";
                openBtn.style.display = "block";
                closeBtn.style.display = "none";
            } else {
                console.error("Elemento não encontrado: ", targetId);
            }
        });
    });
});
