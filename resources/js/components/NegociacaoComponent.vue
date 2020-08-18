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
              <i class="fab fa-cc-mastercard"></i> <span style="font-size:12px;">- 4,99%</span>
            </div>
          </div>
        </div>

        <div class="body-calculo">
          <div class="custos">
            <div class="valor-custo-item">
              <label for>custo item (s)</label>
              <input type="text" class="form-control" v-model.number="custo_itens" />
            </div>
            <div class="valor-frete-considerado">
              <label for>Valor Frete</label>
              <input type="text" class="form-control" v-model.number="valor_frete_considerado" />
            </div>

            <div class="percento-desconto">
              <label for>% Desconto</label>
              <input type="number" class="form-control" v-model.number="percentual_desconto" />
            </div>

            <div class="check-frete">
              <label for>Frete?</label>
              <input type="checkbox" class="form-control" v-model="frete_gratis" />
            </div>

            <div class="calcula">
              <!-- <label for="">Frete?</label> -->
              <!-- <input type="checkbox" class="form-control" v-model="frete_gratis"> -->
              <button class="btn btn-success" @click="calculateList()">
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
              <input type="text" class="form-control" v-model.number="lucro_sobre_venda_percento_prazo" />
            </div>
            <div class="margem-svr">
              <label for>
                Lucro sobre
                <br />venda R$
              </label>
              <input type="text" class="form-control" v-model.number="lucro_sobre_venda_reais_prazo" />
            </div>

            <div class="margem-cs">
              <label for>Margem % Considerada</label>
              <input type="text" class="form-control" v-model.number="margem_lucro_considerado" />
            </div>
          </div>
        </div>

        <div class="frete-calculo">
          <div class="lista-frete-head">
            <div class="txt-calcular-frete">Efetuar Calculo de Frete</div>
            <button class="btn btn-success btn-calcular-frete" @click="calculaFrete()"><i class="fas fa-truck"></i></button>
          </div>
          <div class="lista-frete">

              <div class="frete-hr">
                <div class="logo">Transp</div>

                <div class="Transp">Serviço</div>
                
                <div class="Desconto">Desconto</div>
                <div class="Preço">Valor Frete</div>
                <div class="btn-frete"></div>
              </div>
              <!-- <div class="produto" v-for="(item, index) in items" :key="item.id"> -->
              <div class="frete" v-for="(g_frete, index_f) in lista_fretes" :key="g_frete.id">

                <div class="picture">
                  <img v-bind:src="g_frete.company.picture" width="60px">
                </div>

                <div class="company">{{g_frete.name}}</div>
                
                <div class="discount">R$ {{g_frete.discount}}</div>
                <div class="custom-price">R$ {{g_frete.price}}</div>
                <div class="select-frete">
                  <button class="btn btn-primary" @click="selecFrete(index_f)">
                    <i class="fas fa-hand-pointer"></i>
                  </button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      AuthStr: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFhMGFlMzU1NjJiZDM0NTQ2MjNjNThhMTlhNjdhOWE3Zjc3ZmE1NzE5ZTM5MGY3MzJhNTdjNmFiMWVmOWEwNzdmOWE2MWJjMTBjNjMxMTU2In0.eyJhdWQiOiIxIiwianRpIjoiMWEwYWUzNTU2MmJkMzQ1NDYyM2M1OGExOWE2N2E5YTdmNzdmYTU3MTllMzkwZjczMmE1N2M2YWIxZWY5YTA3N2Y5YTYxYmMxMGM2MzExNTYiLCJpYXQiOjE1OTc1MzE2OTYsIm5iZiI6MTU5NzUzMTY5NiwiZXhwIjoxNjI5MDY3Njk2LCJzdWIiOiJhZDE0NTljZi0zYTI0LTQ4OGQtOGI1My1mMjc0Yjc3MWU3ODciLCJzY29wZXMiOlsiY2FydC1yZWFkIiwiY2FydC13cml0ZSIsImNvbXBhbmllcy1yZWFkIiwiY29tcGFuaWVzLXdyaXRlIiwiY291cG9ucy1yZWFkIiwiY291cG9ucy13cml0ZSIsIm5vdGlmaWNhdGlvbnMtcmVhZCIsIm9yZGVycy1yZWFkIiwicHJvZHVjdHMtcmVhZCIsInByb2R1Y3RzLXdyaXRlIiwicHVyY2hhc2VzLXJlYWQiLCJzaGlwcGluZy1jYWxjdWxhdGUiLCJzaGlwcGluZy1jYW5jZWwiLCJzaGlwcGluZy1jaGVja291dCIsInNoaXBwaW5nLWNvbXBhbmllcyIsInNoaXBwaW5nLWdlbmVyYXRlIiwic2hpcHBpbmctcHJldmlldyIsInNoaXBwaW5nLXByaW50Iiwic2hpcHBpbmctc2hhcmUiLCJzaGlwcGluZy10cmFja2luZyIsImVjb21tZXJjZS1zaGlwcGluZyIsInRyYW5zYWN0aW9ucy1yZWFkIiwidXNlcnMtcmVhZCIsInVzZXJzLXdyaXRlIiwid2ViaG9va3MtcmVhZCIsIndlYmhvb2tzLXdyaXRlIiwibWluaGFzdmVuZGFzOjpjbGllbnRzOnJlYWQiLCJtaW5oYXN2ZW5kYXM6OmNsaWVudHM6d3JpdGUiLCJtaW5oYXN2ZW5kYXM6OnNhbGVzOnJlYWQiLCJtaW5oYXN2ZW5kYXM6OnNhbGVzOndyaXRlIiwibWluaGFzdmVuZGFzOjp3ZWJob29rczpyZWFkIiwibWluaGFzdmVuZGFzOjp3ZWJob29rczp3cml0ZSIsIm1pbmhhc3ZlbmRhczo6c2hpcHBpbmdzOnJlYWQiLCJtaW5oYXN2ZW5kYXM6OnNoaXBwaW5nczp3cml0ZSIsIm1pbmhhc3ZlbmRhczo6Y29uY2lsaWF0aW9uczpyZWFkIiwibWluaGFzdmVuZGFzOjpjb25jaWxpYXRpb25zOndyaXRlIl19.LfyAen7Xl4C6YcWu5fGzKKcDD2LmnW-uWqBIenTxsQSFofYeUOsJLDOYSIPp4Pam2xkHItRvRsrtDAyjT0aUtMpFgNhj8brttehdx1A53CMoQfAWyLabJgoczRLxZutcW38A7j1BNocfTbHCfTWmhw-htOkHdglo4xtJEibnjDrL2I6paQYU_K1sAeXx1iHe5MD7NSySbwFGHd3S4D-UvXEKrkIStOpDxW-cK_aavX6KN_xi-yMtqm3H_VvnunDH2RjQIPjl_MmneQ8oToEzOIdZybqB0MVsy7rPN7peeGgybBQrKQj7ns523RC3_JrIpkFRLajjh4BCBV3fUpx5C2EJU4sZf3csvuBarGguSwXZ1N71yGK0Zo8NbkddiDHUgWDSPIQac2aga5cJ1lu0sgwDJIUpkAj88kMn7B8uRDwjyYMfcw2dLi8R8eyVF9tq4nTOloregAIIM9L8BdTwOv2D46x3phEJWF1OZSHn2jKwQ5H7P7aVAmKjzErxbcrEvVtoaeQM6BxYdiP8MSwARYhZWSo22x-TNpyVTWghO0ppVjfC4AAPaqZWc-QCLsz4aa2zy2UAPxMOeGwCcdJI842mSGByvjz37dKc7NnQK7hRNhjMG_KIj2O2VF0-sVMxO-xzY7y-cXuR3ZUuOx1ARNixs8Ws3rEWdBLOnubn9rM",
      items: [],
      lista_fretes: [],
      cep_origem: "13604136", //from
      cep_destino: "66070605", //to

      //options
      receipt: false,
      own_hand: false,

      //services
      services: "",
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
      frete_gratis: false,
      margem_lucro_considerado: 30,
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
        this.calculateList()
        // console.log(this.items);
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
      this.calculateList()
    },

    calculateList() {
        if(this.items.length == 0){
            alert("Não à produtos na lista a ser calculado!")
            this.valor_a_vista = 0
            this.valor_a_prazo = 0
            this.custo_itens = 0
            this.valor_frete_considerado = 0
            this.percentual_desconto = 0
            this.lucro_sobre_venda_percento_vista = 0
            this.lucro_sobre_venda_reais_vista = 0
            this.lucro_sobre_venda_percento_prazo = 0
            this.lucro_sobre_venda_reais_prazo = 0
            this.lista_fretes = 0
        }else{

            // this.valor_a_vista
            // this.valor_a_prazo
            // this.custo_itens
            // this.valor_frete_considerado
            // this.percentual_desconto
            // this.frete_gratis
            // this.margem_lucro_considerado
            // this.lucro_sobre_venda_percento_vista
            // this.lucro_sobre_venda_reais_vista
            // this.lucro_sobre_venda_percento_prazo
            // this.lucro_sobre_venda_reais_prazo

            let index = 0
            let valorCompra = 0
            let valorVenda = 0

            while(index < this.items.length){
                valorCompra += (this.items[index].qtd * this.items[index].valor_custo);
                valorVenda += (this.items[index].qtd * this.items[index].valor_venda);
                console.log(this.items[index]);
                index++
            }

            //OFERECE FRETE GRATIS?
            if(this.frete_gratis){
                this.custo_itens = (valorCompra) + (this.valor_frete_considerado)
            }else{
                this.custo_itens = (valorCompra)
            }
            

            //CALCULA VENDA A PRA E VENDA A VISTA
            if(this.percentual_desconto <= 0){
                this.percentual_desconto = 0
            }
            this.valor_a_vista = valorVenda - ((valorVenda/100) * this.percentual_desconto )
            this.valor_a_vista = this.valor_a_vista.toFixed(2)
            
            this.valor_a_prazo = valorVenda
            this.valor_a_prazo = this.valor_a_prazo.toFixed(2)

            //MARGENS DE LUCRO SOBRE VENDA
            // this.margem_lucro_considerado


            // MAGEM DE CALCULO A VISTA
            this.lucro_sobre_venda_percento_vista = ((this.valor_a_vista-this.custo_itens)/this.custo_itens)*100;
            this.lucro_sobre_venda_percento_vista = this.lucro_sobre_venda_percento_vista.toFixed(2);

            this.lucro_sobre_venda_reais_vista = (this.valor_a_vista-this.custo_itens)
            this.lucro_sobre_venda_reais_vista = this.lucro_sobre_venda_reais_vista.toFixed(2)
            
            
            // MAGEM DE CALCULO A PRAZO
            
            this.lucro_sobre_venda_percento_prazo = ((this.valor_a_prazo - (this.custo_itens + ((this.valor_a_prazo/100)*4.99)))/this.custo_itens)*100
            this.lucro_sobre_venda_percento_prazo = this.lucro_sobre_venda_percento_prazo.toFixed(2)

            this.lucro_sobre_venda_reais_prazo = this.valor_a_prazo - (this.custo_itens + ((this.valor_a_prazo/100)*4.99))
            this.lucro_sobre_venda_reais_prazo = this.lucro_sobre_venda_reais_prazo.toFixed(2)

            this.custo_itens = this.custo_itens.toFixed(2) 
        }
    },
    calculaFrete () {
      let products = [];
      let index = 0;
      let URL = "https://melhorenvio.com.br/api/v2/me/shipment/calculate"
      let config = {

          headers: {
            'Accept' : 'application/json',
            'Content-Type' : 'application/json',
            'Authorization': this.AuthStr
            }
        }
      let fretesJSON = []
          
      if(this.items.length > 0 && this.cep_destino.length > 0){
          
          while(index < this.items.length ){
            products.push({"id": this.items[index].codigo,
                        "width": this.items[index].largura,
                        "height": this.items[index].altura,
                        "length": this.items[index].comprimento,
                        "weight": this.items[index].peso,
                        "insurance_value": this.items[index].valor_venda,
                        "quantity": this.items[index].qtd,
                        })

            index++
          }


          
          fretesJSON ={ 
            "from": {
                "postal_code": this.cep_origem
              },
              "to": {
                "postal_code": this.cep_destino
              },
              "options": {
                "receipt": this.receipt,
                "own_hand": this.own_hand
              },
              "services": this.services,
              "products": products
          }

          axios.post(URL, JSON.stringify(fretesJSON), config)
          .then(response => {
              console.log(response.data);
              this.lista_fretes = response.data
          })
          .catch((error) => {
            console.log(error)
          })

          console.log(this.lista_fretes);
      }
      else{
          console.log("nao à produtos na lista!"); 
      }
    },

    selecFrete(index) {
      let valorFrete = parseFloat( this.lista_fretes[index].price)
      this.valor_frete_considerado = parseFloat(valorFrete.toFixed(2))
      alert("Frete Considerado: "+ this.lista_fretes[index].company.name +" R$ "+this.lista_fretes[index].price )
      if(this.freeFrete){
        this.calculateList()
      }
    },
    freeFrete: () => {},
  },
};
</script>
