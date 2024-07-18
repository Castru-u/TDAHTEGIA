const html = document.querySelector('html')
const checkbox = document.querySelector("input[name=theme]")

const getStyle = (elemento, estilo) => 
    window
        .getComputedStyle(elemento)
        .getPropertyValue(estilo)

const coresIniciais = {
  corFundoCorpo: getStyle(html, '--body-color'),
  corCabecalho: getStyle(html, '--header-color'),
  corBotaoCabecalho: getStyle(html, '--header-button'),
  corDiasSemana: getStyle(html, '--color-weekdays'),
  corDiaAtual: getStyle(html, '--current-day'),
  corEvento: getStyle(html, '--event-color'),
  corDia: getStyle(html, '--color-day'),
  corModalEvento: getStyle(html, '--modal-event')
}

const modoEscuro = {
  corFundoCorpo: '#282a36',
  corCabecalho: '#ff5555',
  corBotaoCabecalho: '#bd93f9',
  corDiasSemana: '#6272a4',
  corDiaAtual: '#f8f8f2',
  corEvento: '#6272a4',
  corDia: '#44475a',
  corModalEvento: '#6272a4'
}

const transformarChave = chave => 
    "--" + chave.replace(/([A-Z])/, "-$1").toLowerCase()

const mudarCores = (cores) => {
    Object.keys(cores).map(chave => {
        html.style.setProperty(transformarChave(chave), cores[chave])
      }
    )
}

checkbox.addEventListener("change", ({target}) => {
    target.checked ? mudarCores(modoEscuro) : mudarCores(coresIniciais)
})
