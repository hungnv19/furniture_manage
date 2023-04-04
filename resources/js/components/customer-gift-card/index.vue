<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <UpdateGiftCard
        :idCustomerGiftCard="this.idCustomerGiftCard"
        :giftCards="this.data.giftCards"
        :listGiftCardAvailable="this.data.listGiftCardAvailable"
      ></UpdateGiftCard>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
              <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
              >
                <h2 class="m-0 font-weight-bold text-primary">title</h2>
               
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>code</th>
                      <th>type</th>
                      <th>balance</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="customerGiftCard in filtersearch"
                      :key="customerGiftCard.id"
                    >
                      <td>{{ customerGiftCard.code }}</td>
                      <td>{{ customerGiftCard.type }}</td>
                      <td>{{ number_format(customerGiftCard.balance) }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'editGiftCard',
                            params: { id: customerGiftCard.id },
                          }"
                          class="btn btn-sm btn-primary btn-submit"
                          >edi</router-link
                        >
                        <a
                          @click="deleteGiftCard(customerGiftCard.id)"
                          class="btn btn-sm btn-danger"
                          style="color: white"
                          >delete</a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { CardType, CardTypeDetail } from "../../enums/CardType";
import {
  StatusGiftCard,
  StatusGiftCardDetail,
} from "../../enums/StatusGiftCard";
import UpdateGiftCard from "./updateGiftCard.vue";
export default {
  created() {
  },
  components: {
    UpdateGiftCard,
  },
   props: [ "data", "giftCards"],
  data() {
    return {
      customerGiftCard: [],
      searchTerm: "",
      StatusGiftCardDetail: StatusGiftCardDetail,
      idCustomerGiftCard: "",
      giftCards: [],
      listGiftCardAvailable: [],
    };
  },
  computed: {
    filtersearch() {
      return this.customerGiftCard;
    },
  },
  methods: {
    number_format(value) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(value);
    },
    // allCustomerGiftCard() {
    //   axios
    //     .get("/list-card-gift/"+ id)
    //     .then(({ data }) => {
    //       console.log(data);
    //       this.customerGiftCard = data;
    //     })
    //     .catch();
    // },
    deleteGiftCard(id) {
      Swal.fire({
        title: this.$t("common.message.delete.confirm"),
        text: this.$t("common.message.delete.warning"),
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: this.$t("common.button.confirm_delete"),
        cancelButtonText: this.$t("common.button.cancel"),
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("/customer-gift/" + id)
            .then(() => {
              this.customerGiftCard = this.customerGiftCard.filter(
                (customerGiftCard) => {
                  return customerGiftCard.id != id;
                }
              );
              location.reload();
            })
            .catch(() => {
              this.$router.push({ name: "customerGiftCard" });
            });

          Swal.fire(
            this.$t("common.message.delete.deleted"),
            this.$t("common.message.delete.success", {
              category: this.$t("side_bar.nav_items.gift_card.name"),
            }),
            this.$t("common.message.success")
          );
        }
      });
    },
    getId(e) {
      this.idCustomerGiftCard = e;
    },
  },
  mounted() {
    // this.allCustomerGiftCard();
  },
};
</script>

<style lang="css" scoped>
</style>
