<!doctype html>
<html class="h-100">
<head>
    <meta charset="utf-8">
    <title>Mutabi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>
<body class="d-flex h-100 text-bg-dark">
<div id="myApp" class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <nav class="navbar navbar-dark bg-dark">
                <div class="container-fluid">
                    <p></p>
                    <button v-if="!hideConfig" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar">
                        <div class="offcanvas-header">
                            <div class="d-flex align-items-center">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Configurações</h5>
                                <div :class="[startApp ? 'bg-my-success b-shadow-cs' : 'bg-warning b-shadow-wr', 'state-app']"></div>
                            </div>
                            <button type="button" id="closeConfig" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form class="row g-3">
                                <div class="col-12">
                                    <div class="d-flex align-items-center flex-column">
                                        <img src="https://www.pucgoias.edu.br/wp-content/uploads/2020/08/puc-goias.svg" width="150" alt="LogoPuc">
                                        <h5 class="form-label mt-4">Desenvolvido por:</h5>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="d-flex" style="gap: 7px;"><strong>Delineamento:</strong> Lorismario Ernesto Simonassi, <br> Júlio César Abdala Filho</span>
                                        <span class="d-flex" style="gap: 7px;"><strong>Automação:</strong> Daniel Bueno de Oliveira</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <h5 class="form-label">Informações pessoais</h5>
                                </div>
                                <div class="col-12">
                                    <label for="inputNome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="inputNome" v-model="nome">
                                </div>
                                <div class="col-7">
                                    <label for="inputSexo" class="form-label">Sexo</label>
                                    <select id="inputSexo" class="form-select" v-model="sexo">
                                        <option value="masculino">Masculino</option>
                                        <option value="feminino">Feminino</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="inputIdade" class="form-label">Idade</label>
                                    <input type="number" class="form-control" id="inputIdade" v-model="idade">
                                </div>
                                <div class="col-12">
                                    <label for="inputExperimentador" class="form-label">Experimentador</label>
                                    <input type="text" class="form-control" id="inputExperimentador" v-model="experimentador">
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <h5 class="form-label">Parâmetros</h5>
                                </div>
                                <div class="col-3">
                                    <label for="inputState" class="form-label">Matriz</label>
                                    <select id="inputState" class="form-select" v-model="nMatrizTamanho" disabled>
                                        <option value="5">5x5</option>
                                        <option>6x6</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <label for="inputAddress34" class="form-label">Esquema em vigor</label>
                                    <select id="inputAddress34" class="form-select" v-model="tipoPontuacao">
                                        <option value="variacao">Variação</option>
                                        <option value="repeticao">Repetição</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="inputLag" class="form-label">LAG</label>
                                    <input type="number" class="form-control" id="inputLag" v-model="lag" :disabled="tipoPontuacao === 'repeticao'">
                                </div>
                                <div class="col-2">
                                    <label for="inputColor" class="form-label">Cor</label>
                                    <input type="color" class="form-control form-control-color" id="inputColor" v-model="color" title="Cor que será preenchida ao clicar na matriz">
                                </div>
                                <div class="col-6">
                                    <label for="inputPtGanhosPorAcerto" class="form-label">Pts. ganhos por acerto</label>
                                    <input type="number" class="form-control" id="inputPtGanhosPorAcerto" v-model="ptGanhosPorAcerto">
                                </div>
                                <div class="col-6">
                                    <label for="inputPtParaEncerrar" class="form-label">Qtd. pontos possíveis</label>
                                    <input type="number" class="form-control" id="inputPtParaEncerrar" v-model="ptParaEncerrar">
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <h5 class="form-label">Critérios de Encerramento</h5>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Qtd. acertos possíveis</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" v-model="hasQtdPontosPossiveis">
                                        </div>
                                        <input type="number" class="form-control" v-model="qtdPontosPossiveis">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Qtd. de erros possíveis</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" v-model="hasQtdErrosPossiveis">
                                        </div>
                                        <input type="number" class="form-control" v-model="qtdErrosPossiveis">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Número de tentativas</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" v-model="hasNumTentativas">
                                        </div>
                                        <input type="number" class="form-control" v-model="numTentativas">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="inputDuracao" class="form-label">Tempo</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" v-model="hasTempo">
                                        </div>
                                        <input type="number" class="form-control" id="inputDuracao" v-model="tempo">
                                        <span class="input-group-text">Min.</span>
                                    </div>
                                </div>
                                <div class="col-12"><hr></div>
                                <div class="col-12 mt-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" v-model="hasViewInstrucao">
                                        <label class="form-check-label" for="inputInstrucao">
                                            Instrução
                                        </label>
                                    </div>
                                    <textarea class="form-control" id="inputInstrucao" rows="6" v-model="instrucao"></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="checkViewCaminhos" v-model="hasViewCaminhos">
                                        <label class="form-check-label" for="checkViewCaminhos">Caminhos</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="checkViewAcertos" v-model="hasViewAcertos">
                                        <label class="form-check-label" for="checkViewAcertos">Acertos</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="checkViewErros" v-model="hasViewErros">
                                        <label class="form-check-label" for="checkViewErros">Erros</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="checkViewTempo" v-model="hasViewTempo">
                                        <label class="form-check-label" for="checkViewTempo">Tempo</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-0">
                                    <hr>
                                    <button v-if="!startApp" type="button" class="btn btn-primary" @click="start()">Salvar e Iniciar</button>
                                    <button v-if="startApp" type="button" class="btn btn-danger" @click="stop()">Parar</button>
                                    <button type="button" class="btn btn-success ml-5" @click="exportFile()">Exportar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="container-fluid px-3">
        <div id="view">
            <div v-if="hasViewInstrucao" class="instructions">
                <div class="card text-bg-dark">
                    <div class="card-header text-center">
                        <h5 class="card-title">Instruções</h5>
                    </div>
                    <div class="card-body">
                        <div class="align-items-left" v-html="replaceInstrucao"></div>
                    </div>
                </div>
            </div>
            <div class="matriz">
                <div class="matriz-col" v-for="(itens, i) in matriz">
                    <div
                        class="matriz-row"
                        v-for="(item, j) in itens"
                        @click="registerClick(i, j)"
                        :style="{backgroundColor: item.color}"
                    >
                        {{ i === 0 && j === 0 ? 'Inicio' : (i === 4 && j === 4 ? 'Fim' : '') }}
                    </div>
                </div>
            </div>
            <div class="cards-right" :style="hasViewCaminhos ? { justifyContent: 'flex-end' } : {}">
                <div v-if="hasViewAcertos || hasViewErros || hasViewTempo" class="score">
                    <div class="card text-bg-dark">
                        <div class="card-header text-center">
                            <h5 class="card-title">Pontuação</h5>
                        </div>
                        <div class="card-body" style="font-size: 20px;">
                            <div v-if="hasViewAcertos" class="d-flex justify-content-between align-items-center">
                                Acertos <span class="badge bg-success rounded-pill">{{ buffer.acertos }}</span>
                            </div>
                            <hr v-if="hasViewErros && hasViewAcertos" class="mt-2">
                            <div v-if="hasViewErros" class="d-flex justify-content-between align-items-center">
                                Erros <span class="badge bg-danger rounded-pill">{{ buffer.erros }}</span>
                            </div>
                            <hr v-if="hasViewTempo" class="mt-2">
                            <div v-if="hasViewTempo" class="d-flex justify-content-between align-items-center">
                                Tempo <span class="badge bg-secondary rounded-pill">
                                {{ countdownHours }}:{{ countdownMinutes }}:{{ countdownSeconds }}
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="hasViewCaminhos" class="caminhos">
                    <div class="card text-bg-dark">
                        <div class="card-header text-center">
                            <h5 class="card-title">Caminhos Percorridos</h5>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="mt-auto text-white-50"><p></p></footer>
</div>

<script type="module">
  const { createApp } = Vue

  window.sanitizeCsv = function (strData) {
    const riskyChars = ['=', '+', '-', '@']

    const sanitizeCsvItem = str => {
      if (!str) return ''

      const firstChar = str.charAt(0)
      const isInjected = riskyChars.includes(firstChar)

      if (!isInjected) return str

      return sanitizeCsvItem(str.slice(1))
    }

    const lineSeparators = /\r\n|\r|\n/g
    const columnSeparator = ';'
    return strData.split(lineSeparators).map(line => {
      return line.split(columnSeparator).map(x => {
        x = x.trim()

        if (x.startsWith('"')) {
          return '"' + sanitizeCsvItem(x.slice(1).trim())
        }

        return '"' + sanitizeCsvItem(x) + '"'
      }).join(columnSeparator)
    }).join('\n')
  }

  createApp({
    data() {
      return {
        startApp: false,
        hideConfig: false,
        notification: true,
        matriz: [],
        tempMatriz: [],
        nome: '',
        idade: 0,
        sexo: 'masculino',
        experimentador: '',
        nMatrizTamanho: 5,
        tipoPontuacao: 'variacao',
        lag: 0,
        color: '#FFFF00',
        ptGanhosPorAcerto: 1,
        ptParaEncerrar: 50,
        hasQtdPontosPossiveis: false,
        qtdPontosPossiveis: 1,
        hasQtdErrosPossiveis: false,
        qtdErrosPossiveis: 1,
        hasNumTentativas: false,
        numTentativas: 1,
        hasTempo: false,
        tempo: 0,
        hasViewInstrucao: true,
        instrucao: '',
        hasViewCaminhos: true,
        hasViewAcertos: true,
        hasViewErros: true,
        hasViewTempo: true,
        buffer: {
          sequencias: [],
          lagErros: [],
          lagAcertos: [],
          acertos: 0,
          erros: 0,
          tempo: 0
        },
        X:['A', 'B', 'C', 'D', 'E', 'F'],
        Y:['1', '2', '3', '4', '5', '6'],
        tempos: {
          duracao: 0,
          IES: 0,
          IRT: 0,
        },
        countdownHours: '0',
        countdownMinutes: '00',
        countdownSeconds: '00',
        myInterval: null
      }
    },
    computed: {
      replaceInstrucao() {
        return this.instrucao.replace(/\n/g, "<br />")
      }
    },
    watch: {
      color() {
        if (this.color === '#F8F8F8') {
          alert('Essa cor não pode ser escolhida pois é idêntica a cor default da matriz! Selecione outra cor.')
          this.color = '#FFFF00'
        }
      },
      tipoPontuacao () {
        if (this.tipoPontuacao === 'repeticao') {
          this.lag = 0
        }
      },
      startApp () {
        if (!this.startApp && this.notification) {
          setTimeout(() => {
            this.exportFile()
            alert('FIM DO EXPERIMENTO. CHAME O EXPERIMENTADOR!')
          }, 1000)
        }
      },
      tempMatriz: {
        deep: true,
        handler() {
          console.log(this.tempMatriz)
        }
      },
      buffer: {
        deep: true,
        handler() {
          console.log(this.buffer)
        }
      }
    },
    created () {
      this.initializeMatriz()
    },
    mounted () {
      const self = this
      document.addEventListener("keydown", function(event) {
        if (event.metaKey && event.key === "n") {
          self.hideConfig = !self.hideConfig
        }
      });
    },
    methods: {
      initializeBuffer () {
        this.buffer = {
          sequencias: [],
          lagErros: [],
          lagAcertos: [],
          acertos: 0,
          erros: 0,
          tempo: 0
        }
      },
      initializeMatriz () {
        this.tempMatriz = []
        for (let i = 0; i < this.nMatrizTamanho; i++) {
          this.matriz[i] = []
          for (let j = 0; j < this.nMatrizTamanho; j++) {
            this.matriz[i][j] = {color: '#F8F8F8'}
          }
        }
      },
      validAxes (last, key) {
        const keyXY = key.split(':')
        const lastXY = last ? last.split(':') : ['Z', '10']
        const x = this.X
        const y = this.Y

        if (this.tempMatriz.length > 1 && this.tempMatriz.at(-2).casa === key) {
          return false
        }

        const validAxesX = x.indexOf(keyXY[0]) === x.indexOf(lastXY[0]) + 1 && y.indexOf(keyXY[1]) === y.indexOf(lastXY[1])
        const validAxesY = y.indexOf(keyXY[1]) === y.indexOf(lastXY[1]) + 1 && x.indexOf(keyXY[0]) === x.indexOf(lastXY[0])

        return validAxesX || validAxesY
      },
      registerClick (i, j) {
        const key = this.X[i]+':'+this.Y[j]
        const ini = 'A:1'
        const end5x5 = 'E:5'
        const lastClick = this.tempMatriz.length > 0 ? this.tempMatriz.at(-1).casa : null
        const isFirstClick = !lastClick && key === ini

        if (!this.startApp || lastClick === end5x5 || (this.tempMatriz.length < 8 && key === end5x5)) {
          return
        }

        if (isFirstClick) {
          this.tempos.duracao = (new Date()).getTime()
          this.tempos.IRT = (new Date()).getTime()
        }

        let cor = ''
        if (isFirstClick || this.validAxes(lastClick, key)) {
          this.tempMatriz.push({
            casa: key,
            IRT: isFirstClick ? 0 : ((new Date()).getTime() - this.tempos.IRT) / 1000,
            IES: !isFirstClick || this.buffer.sequencias.length === 0 ? 0 : ((new Date()).getTime() - this.tempos.IES) / 1000,
            duracao: !(key === end5x5) ? 0 : ((new Date()).getTime() - this.tempos.duracao) / 1000,
          })
          if (!isFirstClick) {
            this.tempos.IRT = (new Date()).getTime()
          }
          cor = this.color
        }

        if (cor) { this.matriz[i][j] = { color: cor } }

        if (key === end5x5) {
          this.tempos.IES = (new Date()).getTime()
          this.registraAcertoOuErro()
          setTimeout(() => {
            this.initializeMatriz()
          }, 1000)
        }
      },
      start () {
        this.startApp = true
        this.hideConfig = true
        this.notification = true
        this.initializeMatriz()
        this.initializeBuffer()
        document.getElementById('closeConfig').click()

        if (this.hasTempo && this.tempo > 0) {
          let duracaoEmSegundos = this.tempo * 60

          clearInterval(this.myInterval)
          this.myInterval = setInterval(() => {
            const finish = new Date(new Date().getTime() + duracaoEmSegundos * 1000).getTime();
            // Get today's date and time
            const now = new Date().getTime()
            const distance = finish - now

            let hours, minutes, seconds

            if (distance <= 0) {
              this.countdownHours = '0'
              this.countdownMinutes = '00'
              this.countdownSeconds = '00'
            } else {
              hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
              this.countdownHours = parseInt(hours) < 10 ? `0${hours}` : hours
              minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
              this.countdownMinutes = parseInt(minutes) < 10 ? `0${minutes}` : minutes
              seconds = Math.floor((distance % (1000 * 60)) / 1000)
              this.countdownSeconds = parseInt(seconds) < 10 ? `0${seconds}` : seconds
            }

            duracaoEmSegundos--
            if (duracaoEmSegundos === 0 || !this.startApp) {
              this.startApp = false
              // limpa e sai do setInterval
              clearInterval(this.myInterval)
            }

          }, 1000)
        } else {
          this.countdownHours = '0'
          this.countdownMinutes = '00'
          this.countdownSeconds = '00'
        }
      },
      stop () {
        this.notification = false
        this.startApp = false
      },
      exportFile () {
        let file = '\n'
        file += ';Nome do participante;Idade do participante;Sexo do participante;Nome do experimentador\n'
        file += `;${this.nome};${this.idade};${this.sexo};${this.experimentador}\n\n\n`
        file += ';Esquema em vigor;LAG;Pontos ganhos por acerto;Quantidade de pontos possíveis\n'
        file += `;${this.tipoPontuacao};${this.lag};${this.ptGanhosPorAcerto};${this.ptParaEncerrar}\n\n`
        if (this.hasQtdPontosPossiveis || this.hasQtdErrosPossiveis || this.hasNumTentativas || this.hasTempo)  {
          file += ';Critérios de Encerramento\n'
          file += this.hasQtdPontosPossiveis ? ';Qtd. acertos possíveis' : ''
          file += this.hasQtdErrosPossiveis ? ';Qtd. de erros possíveis' : ''
          file += this.hasNumTentativas ? ';Número de tentativas' : ''
          file += this.hasTempo ? ';Tempo' : ''
          file += '\n'
          file += this.hasQtdPontosPossiveis ? `;${this.tipoPontuacao}` : ''
          file += this.hasQtdErrosPossiveis ? `;${this.lag}` : ''
          file += this.hasNumTentativas ? `;${this.ptGanhosPorAcerto}` : ''
          file += this.hasTempo ? `;${this.ptParaEncerrar}` : ''
          file += '\n\n'
        }
        file += `;Acertos;Erros;Duração\n`
        file += `;${this.buffer.acertos};${this.buffer.erros};${0x00}\n`
        file += `;;;;;;;;;;;;IES;Duração\n`

        for (const i in this.buffer.sequencias) {
          const sequencia = this.buffer.sequencias[i]

          let lineSeq = 'SEQ-' + parseInt(i)+1 + ';'
          let lineIRT = 'ITR-' + parseInt(i)+1 + ';'
          for (const j in sequencia) {
            const item = sequencia[j]
            if (typeof item === 'object') {
              lineSeq += item.casa.replace(':' , '') + ';'
              lineIRT += item.IRT + ';'
            }
          }

          lineSeq += `;${sequencia.type};${sequencia[0].IES};${sequencia[0].duracao}\n`
          lineIRT += `;;${sequencia[0].IES};${sequencia[0].duracao}\n`

          file += lineSeq
          file += lineIRT
        }

        const sanitizedData = window.sanitizeCsv(file)
        const element = document.createElement('a')
        const blob = new window.Blob(['\ufeff', sanitizedData])
        element.href = URL.createObjectURL(blob)
        element.download = (this.nome ? this.nome : 'Nome') + '.csv'
        element.style.display = 'none'
        document.body.appendChild(element)
        element.click()
        document.body.removeChild(element)
      },
      registraAcertoOuErro () {
        if (this.buffer.sequencias.length > 0) {
          const sequencias = this.buffer.sequencias.map((matriz) => matriz.map((e) => e.casa))
          const newSequencia = this.tempMatriz.map((e) => e.casa)

          if (this.tipoPontuacao === 'repeticao') {
            this.regraRepeticao(sequencias, newSequencia)
          } else {
            this.regraVariacao(sequencias, newSequencia)
          }
          this.buffer.sequencias.push(this.tempMatriz)

        } else {
          this.emitAudioAcerto()
          this.tempMatriz.type = 'ACERTO'
          this.buffer.sequencias.push(this.tempMatriz)

          if (this.tipoPontuacao === 'repeticao' || (this.tipoPontuacao === 'variacao' && parseInt(this.lag) < 2)) {
            this.buffer.acertos += this.ptGanhosPorAcerto
          } else {
            this.buffer.lagAcertos.push(this.tempMatriz)
          }
        }

        if (this.ptParaEncerrar <= this.buffer.acertos) {
          this.startApp = false
        }
        if (this.hasQtdPontosPossiveis && this.qtdPontosPossiveis <= this.buffer.acertos) {
          this.startApp = false
        }
        if (this.hasQtdErrosPossiveis && this.qtdErrosPossiveis <= this.buffer.erros) {
          this.startApp = false
        }
        if (this.hasNumTentativas && this.numTentativas <= this.buffer.sequencias.length + 1) {
          this.startApp = false
        }
      },
      regraRepeticao (sequencias, newSequencia) {
        const hasSequencia = JSON.stringify(sequencias[0]) === JSON.stringify(newSequencia)
        if (hasSequencia) {
          this.tempMatriz.type = 'ACERTO'
          this.buffer.acertos += this.ptGanhosPorAcerto
          this.emitAudioAcerto()
        } else {
          this.tempMatriz.type = 'ERRO'
          this.buffer.erros += 1
          this.emitAudioErro()
        }
      },
      regraVariacao (sequencias, newSequencia) {
        // pega o array de sequencias de acordo com a lag
        let lagSequencias = []
        if (parseInt(this.lag) === 0) {
          lagSequencias = sequencias
        } else if (parseInt(this.lag) === 1) {
          this.buffer.acertos += this.ptGanhosPorAcerto
          this.emitAudioAcerto()
          return
        } else if (parseInt(this.lag) > 1) {
          lagSequencias = this.buffer.lagAcertos.map((matriz) => matriz.map((e) => e.casa))
        }

        // verifica se a nova sequencia existe no array de sequencias
        const hasSequencia = lagSequencias.filter(e => JSON.stringify(e) === JSON.stringify(newSequencia))

        if (hasSequencia.length > 0) {
          this.tempMatriz.type = 'ERRO'
          this.emitAudioErro()
          this.buffer.erros += 1
          if (parseInt(this.lag) > 1) {
            this.buffer.lagErros.push(this.tempMatriz)
          }
        } else {
          this.tempMatriz.type = 'ACERTO'
          this.emitAudioAcerto()
          if (parseInt(this.lag) > 1) {
            this.buffer.lagAcertos.push(this.tempMatriz)
          }
          if (this.buffer.lagAcertos.length === parseInt(this.lag) || parseInt(this.lag) === 0) {
            this.buffer.acertos += this.ptGanhosPorAcerto
            this.buffer.lagAcertos = []
            this.buffer.lagErros = []
          }
        }
      },
      emitAudioAcerto () {
        let context = new AudioContext()
        let oscillator = context.createOscillator()
        let contextGain = context.createGain()

        oscillator.connect(contextGain)
        oscillator.frequency.value = 440.0
        contextGain.connect(context.destination)
        oscillator.start(0)

        contextGain.gain.exponentialRampToValueAtTime(
          0.00001, context.currentTime + 1.8
        )
      },
      emitAudioErro () {
        let context = new AudioContext()
        let oscillator = context.createOscillator()
        let contextGain = context.createGain()

        oscillator.connect(contextGain)
        oscillator.frequency.value = 261.6
        contextGain.connect(context.destination)
        oscillator.start(0)

        contextGain.gain.exponentialRampToValueAtTime(
          0.00001, context.currentTime + 1.0
        )
      }
    }
  }).mount('#myApp')
</script>
<style>
    #view {
        display: flex;
        justify-content: center;
        gap: 50px;
    }
    .state-app {
        margin-left: 10px;
        width: 10px;
        height: 9px;
        border-radius: 10px;
    }
    .bg-my-success {
        background-color: #00ff4c;
    }
    .b-shadow-cs {
        box-shadow: 0 1px 7px #0dbe42;
    }
    .b-shadow-wr {
        box-shadow: 0 1px 7px #ffc107;
    }
    #view .cards-right {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    #view .matriz {
        display: flex;
        justify-content: center;
    }
    #view .matriz .matriz-col .matriz-row {
        font-weight: bold;
        border: 1px solid black;
        border-radius: 2px;
        width: 100px;
        height: 100px;
        cursor: pointer;
        color: black;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #view .caminhos {
        display: flex;
        align-items: flex-end;
    }
    #view .caminhos .card.text-bg-dark {
        width: 250px;
        background-color: #2b373d !important;
    }
    #view .score {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }
    #view .score .card.text-bg-dark {
        width: 250px;
        background-color: #2b373d !important;
    }
    #view .instructions {
        display: flex;
        align-items: flex-start;
    }
    #view .instructions .card.text-bg-dark {
        width: 315px;
        background-color: #2b373d !important;
    }
    #view .instructions .card-body .align-items-left {
        min-height: 418px;
    }
    #view .caminhos .card-body {
        min-height: 215px;
    }
    .ml-5 {
        margin-left: 10px;
    }
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
</style>
</body>
</html>
