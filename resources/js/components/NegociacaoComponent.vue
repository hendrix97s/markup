<template>
  <div class="container-fluid">
    <div class="head-negociacao">
      <div class="pesquisa-item padding">
        <label for="cod-item">Código do item</label>
        <input if="cod-item" type="text" class="form-control" v-model="codigo_item" />
      </div>
      <div class="quantidade-item padding">
        <label for="qtd-item">Qtd item</label>
        <input id="qtd-item" type="number" class="form-control" v-model="qtd_item" />
      </div>
      <div class="add-item padding">
        <button id="add-item" class="btn btn-primary" @click="getItem(codigo_item,qtd_item)">
          <i class="fas fa-search-plus"></i>
        </button>
      </div>
      <div class="cep-origem padding">
        <label for="cep-origem">CEP origem</label>
        <input id="cep-origem" type="text" class="form-control" v-model="cep_origem" />
      </div>
      <div class="cep-destino padding">
        <label for="cep-destino">CEP destino</label>
        <input id="cep-destino" type="text" class="form-control" v-model="cep_destino" />
      </div>
    </div>

    <div class="body-negociacao">
      <div class="lista-itens">
        <div class="produto" v-for="(item, index) in items" :key="item.id">
          <div class="img-item">
            <img v-bind:src="item.img_url" alt />
          </div>

          <div class="descricao">
            <!-- <label for="descricao">Descrição</label> -->
            <input
              type="text"
              class="form-control"
              v-model="item.descricao"
            />
          </div>

          <div class="deleta">
            <button class="btn btn-danger" @click="removeItem(index)">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>

          <div class="quantidade">
            <label>Qtd</label>
            <input type="number" class="form-control" v-model="item.qtd"/>
          </div>

          <div class="altura">
            <label>Altura</label>
            <input type="text" class="form-control" v-model="item.altura" />
          </div>

          <div class="largura">
            <label>Largura</label>
            <input type="text" class="form-control" v-model="item.largura" />
          </div>

          <div class="comprimento">
            <label>Comprimento</label>
            <input type="text" class="form-control" v-model="item.comprimento"/>
          </div>

          <div class="peso">
            <label>Peso Kg</label>
            <input type="text" class="form-control" v-model="item.peso" />
          </div>

          <div class="valor-custo">
            <label>Custo R$</label>
            <input type="text" class="form-control" v-model="item.valor_custo"/>
          </div>

          <div class="valor-venda">
            <label>Venda R$</label>
            <input type="text" class="form-control" v-model="item.valor_venda" />
          </div>
        </div>
      </div>
      <div class="painel-calculo">
        <div class="head-calculo">
          <div class="venda-a-vista">
            <div>Valor à Vista</div>
            <div class="valor-venda-final">R$ {{valor_a_vista}}</div>
            <div class="bandeiras">
              <i class="fas fa-exchange-alt"></i>
            </div>
          </div>
          <div class="venda-a-prazo">
            <div>Valor à Prazo</div>
            <div class="valor-venda-final">R$ {{valor_a_prazo}}</div>
            <div class="bandeiras">
              <i class="fab fa-cc-mastercard"></i>
            </div>
          </div>
        </div>

        <div class="body-calculo">
          <div class="custos">
            <div class="valor-custo-item">
              <label for>custo item (s)</label>
              <input type="text" class="form-control" v-model="custo_itens" />
            </div>
            <div class="valor-frete-considerado">
              <label for>Valor Frete</label>
              <input type="text" class="form-control" v-model="valor_frete_considerado" />
            </div>

            <div class="percento-desconto">
              <label for>% Desconto</label>
              <input type="number" class="form-control" v-model="percentual_desconto" />
            </div>

            <div class="check-frete">
              <label for>Frete?</label>
              <input type="checkbox" class="form-control" v-model="frete_gratis" />
            </div>

            <div class="calcula">
              <!-- <label for="">Frete?</label> -->
              <!-- <input type="checkbox" class="form-control" v-model="frete_gratis"> -->
              <button class="btn btn-success">
                <i class="fas fa-square-root-alt"></i>
              </button>
            </div>
          </div>

          <div class="margem">
            <div class="dsc-margem">
              <i class="fas fa-exchange-alt"></i>
            </div>

            <div class="margem-svp">
              <label for>
                Lucro sobre
                <br />venda %
              </label>
              <input type="text" class="form-control" v-model="lucro_sobre_venda_percento_vista" />
            </div>
            <div class="margem-svr">
              <label for>
                Lucro sobre
                <br />venda R$
              </label>
              <input type="text" class="form-control" v-model="lucro_sobre_venda_reais_vista" />
            </div>

            <div class="margem-cs">
              <label for>Margem % Considerada</label>
              <input type="text" class="form-control" v-model="margem_lucro_considerado" />
            </div>

            <div class="dsc-margem">
              <i class="fab fa-cc-mastercard"></i>
            </div>

            <div class="margem-svp">
              <label for>
                Lucro sobre
                <br />venda %
              </label>
              <input type="text" class="form-control" v-model="lucro_sobre_venda_percento_prazo" />
            </div>
            <div class="margem-svr">
              <label for>
                Lucro sobre
                <br />venda R$
              </label>
              <input type="text" class="form-control" v-model="lucro_sobre_venda_reais_prazo" />
            </div>

            <div class="margem-cs">
              <label for>Margem % Considerada</label>
              <input type="text" class="form-control" v-model="margem_lucro_considerado" />
            </div>
          </div>
        </div>

        <div class="frete-calculo"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      cep_origem: "13604136", //from
      cep_destino: "", //to

      //options
      receipt: false,
      own_hand: false,

      //services
      services: "1.2",
      //products
      img_url: "",
      codigo_item: "", //id
      dsc_item: "",
      largura_item: 0, //width
      altura_item: 0, //height
      comprimento_item: 0, //length
      peso_item: 0, //weight
      valor_venda_item: 0, //insurance_value
      valor_custo_item: 0,
      qtd_item: 1, //quantity

      valor_a_vista: 0,
      valor_a_prazo: 0,
      custo_itens: 0,
      valor_frete_considerado: 0,
      percentual_desconto: 0,
      frete_gratis: true,
      margem_lucro_considerado: 0,
      lucro_sobre_venda_percento_vista: 0,
      lucro_sobre_venda_reais_vista: 0,
      lucro_sobre_venda_percento_prazo: 0,
      lucro_sobre_venda_reais_prazo: 0,
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  
  methods: {
    getItem(codigo_item, qtd) {
      if (codigo_item.length > 6 && qtd > 0) {
        let url = "/produto/" + codigo_item;
        axios
          .get(url)
          .then((response) => {
            this.img_url = response.data.img.img_url;
            this.dsc_item = response.data.item.descricao;
            this.codigo_item = response.data.item.codigo;
            this.largura_item = response.data.item.largura;
            this.altura_item = response.data.item.altura;
            this.comprimento_item = response.data.item.comprimento;
            this.peso_item = response.data.item.peso;
            this.valor_venda_item = response.data.item.valor_venda;
            this.valor_custo_item = response.data.item.valor_compra;
            this.createList();
          })
          .catch((erro) => console.log(erro));
      } else {
        alert("verifica o campo de codigo do item e quantidade!");
      }
    },

    removeItem (index) {
        alert(index)
        this.items.splice(index, 1); //OR   this.$delete(this.items,index)
        console.log(this.items);
    },

    createList() {
      this.items.push({
        img_url: this.img_url,
        codigo: this.codigo_item,
        descricao: this.dsc_item,
        largura: this.largura_item,
        altura: this.altura_item,
        comprimento: this.comprimento_item,
        peso: this.peso_item,
        valor_venda: this.valor_venda_item, //insurance_value
        valor_custo: this.valor_custo_item,
        qtd: this.qtd_item, //quantity
      });
      this.qtd_item = 1;
    },

    calculateList: () => {},
    calculateFrete: () => {},

    selecfrete: () => {},
    freeFrete: () => {},
  },
};
</script>
