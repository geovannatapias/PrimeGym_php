function mostrarOcultarSenhaLogin() {
    const senha = document.getElementById("senhaLogin");
    if (senha) {
        senha.type = senha.type === "password" ? "text" : "password";
    }
}

function mostrarOcultarSenhaCadastro() {
    const senha1 = document.getElementById("senhaCadastro");
    const senha2 = document.getElementById("senhaConfirmacao");

    if (senha1 && senha2) {
        const tipo = senha1.type === "password" ? "text" : "password";
        senha1.type = tipo;
        senha2.type = tipo;
    }
}

const senha1 = document.getElementById("senhaCadastro");
const senha2 = document.getElementById("senhaConfirmacao");

senha1.addEventListener("input", () => senha1.setCustomValidity(""));
senha2.addEventListener("input", () => senha2.setCustomValidity(""));

function validarSenhaCadastro() {
    const valorSenha1 = senha1.value;
    const valorSenha2 = senha2.value;

    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

    // Verifica complexidade da senha
    if (!regex.test(valorSenha1)) {
        senha1.setCustomValidity("Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula, número e caracter especial.");
        senha1.reportValidity();
        return false;
    } else {
        senha1.setCustomValidity("");
    }

    // Verifica se as senhas coincidem
    if (valorSenha1 !== valorSenha2) {
        console.log("Senha1:", JSON.stringify(valorSenha1));
        console.log("Senha2:", JSON.stringify(valorSenha2));

        senha2.setCustomValidity("Senhas diferentes!");
        senha2.reportValidity();
        return false;
    }

    return true;
}

function mask(input, func) {
    setTimeout(() => {
        const valor = func(input.value);
        if (valor !== input.value) input.value = valor;
    }, 1);
}

function mphone(valor) {
    let v = valor.replace(/\D/g, "").replace(/^0/, "");

    if (v.length > 10) {
        // Formato (XX)XXXXX-XXXX
        v = v.replace(/^(\d{2})(\d{5})(\d{4}).*/, "($1)$2-$3");
    } else if (v.length > 5) {
        // Formato (XX)XXXX-XXXX
        v = v.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, "($1)$2-$3");
    } else if (v.length > 2) {
        // Formato (XX)XXXXX
        v = v.replace(/^(\d{2})(\d{0,5})/, "($1)$2");
    } else {
        // Apenas os dois primeiros dígitos
        v = v.replace(/^(\d*)/, "($1");
    }

    return v;
}
