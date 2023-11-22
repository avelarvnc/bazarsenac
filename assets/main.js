function bloquearInput()
{
    const inputs = document.querySelectorAll('input');

    inputs.forEach(function(i) {
        i.disabled = true;
        i.style.backgroundColor = "grey";
    });
}

function confirmacao()
{
    return confirm("Deseja realmente fazer essa operação?");
}