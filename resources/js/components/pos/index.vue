<template>
  <div>
    <!-- <div class="container-fluid" id="container-wrapper"> -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        {{ $t("content.dashboard.title") }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="./">{{ $t("content.dashboard.breadcrumb.home") }}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ $t("content.dashboard.title") }}
        </li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Area Chart -->
      <div class="col-xl-4 col-lg-5">
        <div class="card mb-4">
          <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
          >
            <h5 class="m-0 font-weight-bold text-primary">
              {{ $t("content.pos.expense_insert") }}
            </h5>
            <router-link
              to="/store-customer"
              class="btn btn-primary btn-sm text-color"
              >{{
                $t("common.action.add", {
                  category: $t("common.category.customer"),
                })
              }}</router-link
            >
          </div>
          <div class="card-body">
            <div class="table-responsive" style="font-size: 12px">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>{{ $t("common.table_column.name") }}</th>
                    <th style="text-align: center">
                      {{ $t("content.order_detail.list.qty") }}
                    </th>
                    <th>{{ $t("content.order_detail.list.unit") }}</th>
                    <th>{{ $t("content.order_detail.list.total") }}</th>
                    <th>{{ $t("common.table_column.action") }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="pro in cartProduct" :key="pro.id">
                    <td>{{ pro.product_name }}</td>
                    <td>
                      <div
                        class="d-flex justify-content-center bootstrap-touchspin bootstrap-touchspin-injected"
                      >
                        <span class="input-group-btn input-group-prepend">
                          <button
                            @click.prevent="decrement(pro.id)"
                            class="btn btn-primary btn-sm bootstrap-touchspin-down text-color action"
                            type="button"
                            :disabled="
                              pro.product_quantity <= 1 || nameButton[pro.id]
                            "
                          >
                            -
                          </button>
                        </span>
                        <span
                          class="d-flex justify-content-center"
                          style="width: 30px"
                        >
                          <div>{{ pro.product_quantity }}</div>
                        </span>
                        <span class="input-group-btn input-group-append">
                          <button
                            :disabled="
                              pro.product_quantity >=
                                products.find((x) => {
                                  return x.id == pro.product_id;
                                }).product_quantity || nameButton[pro.id]
                            "
                            @click.prevent="
                              increment(
                                pro.id,
                                pro.product_id,
                                pro.product_quantity
                              )
                            "
                            class="btn btn-primary btn-sm bootstrap-touchspin-up text-color action"
                            type="button"
                          >
                            +
                          </button>
                        </span>
                      </div>
                    </td>
                    <td>{{ number_format(pro.product_price) }}</td>
                    <td>{{ number_format(pro.sub_total) }}</td>
                    <td>
                      <a
                        @click="deleteItem(pro.id)"
                        class="btn btn-sm btn-danger action"
                        style="color: white"
                        >X</a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <input
            type="hidden"
            name="qty"
            v-validate="'required|numeric|min_value:1'"
            v-model="qty"
          />
          <div class="px-4">
            <small class="text-danger">{{ errors.first("qty") }}</small>
          </div>
          <div class="card-footer">
            <div class="order-md-2 mb-4">
              <ul class="list-group mb-3">
                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">
                      {{ $t("content.order_detail.list.total_quantity") }}
                    </h6>
                  </div>
                  <span class="text-muted">{{ qty }}</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">
                      {{ $t("content.order_detail.list.sub_total") }}
                    </h6>
                  </div>
                  <span class="text-muted">{{ number_format(sub_total) }}</span>
                </li>

                <li
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">
                      {{ $t("content.order_detail.list.vat") }}
                    </h6>
                  </div>
                  <span class="text-muted">{{ this.vat }}%</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between bg-light"
                >
                  <div class="text-success">
                    <h6 class="my-0">
                      {{ $t("content.order_detail.list.total") }}
                    </h6>
                  </div>
                  <span class="text-success">{{ number_format(total) }}</span>
                </li>
                <li
                  v-if="giftCardId"
                  class="list-group-item d-flex justify-content-between lh-condensed"
                >
                  <div>
                    <h6 class="my-0">Gift Card</h6>
                  </div>
                  <span class="text-muted"> - {{ number_format(total) }}</span>
                </li>
              </ul>

              <form @submit.prevent="orderDone">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">{{
                    $t("common.label.select", {
                      category: $t("common.category.customer"),
                    })
                  }}</label>
                  <Select2
                    @select="selectCustomerId($event)"
                    :options="myOptions"
                    :placeholder="
                      this.$t('common.label.select', {
                        category: $t('common.category.customer'),
                      })
                    "
                  />
                  <input
                    type="hidden"
                    name="customer_id"
                    v-validate="'required'"
                    v-model="customer_id"
                  />
                  <small class="text-danger">{{
                    errors.first("customer_id")
                  }}</small>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlSelect2">{{
                    $t("content.orders.list.pay_by")
                  }}</label>
                  <select
                    class="form-control"
                    id="exampleFormControlSelect2"
                    name="payBy"
                    v-model="payBy"
                    v-validate="'required'"
                  >
                    <option value="handCash">
                      {{ $t("content.orders.method.hand_cash") }}
                    </option>
                    <option value="giftCard">
                      {{ $t("content.orders.method.gift_card") }}
                    </option>
                  </select>
                  <small class="text-danger">{{ errors.first("payBy") }}</small>
                </div>

                <div v-if="payBy === 'giftCard'" class="form-group">
                  <label for="exampleFormControlSelect2">{{
                    $t("content.orders.method.gift_card")
                  }}</label>
                  <Select2
                    @select="selectGiftCard($event)"
                    :options="giftCardOptions"
                    :placeholder="this.$t('common.label.select_card')"
                  />
                  <input
                    type="hidden"
                    name="gift_card_id"
                    v-model="giftCardId"
                    v-validate="
                      payBy === 'giftCard'
                        ? 'required|valid_card'
                        : 'valid_card'
                    "
                  />
                  <small class="text-danger">{{
                    errors.first("gift_card_id")
                  }}</small>
                </div>
                <div v-if="payBy === 'handCash'">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">{{
                      $t("content.orders.list.pay")
                    }}</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="pay"
                      v-validate="
                        payBy === 'handCash'
                          ? 'required|numeric|min_value:' + total
                          : 'numeric|min_value:0'
                      "
                      name="pay"
                      id="exampleFormControlInput1"
                      @keyup="calculatorDue"
                    />
                    <small class="text-danger">{{ errors.first("pay") }}</small>
                  </div>
                  <div class="form-group">
                    <div class="d-flex justify-content-between">
                      <label for="exampleFormControlInput2">{{
                        $t("content.orders.list.due")
                      }}</label>
                      <label for="">{{
                        this.number_format(pay - this.total)
                      }}</label>
                    </div>
                    <input
                      type="hidden"
                      class="form-control"
                      v-model="due"
                      name="due"
                      id="exampleFormControlInput2"
                    />
                  </div>
                </div>

                <button class="btn btn-success" type="submit">
                  {{ $t("common.button.submit") }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Pie Chart -->
      <div class="col-xl-8 col-lg-7">
        <div class="card mb-4">
          <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
          >
            <h5 class="m-0 font-weight-bold text-primary">
              {{ $t("content.pos.products") }}
            </h5>

            <input
              type="text"
              :placeholder="$t('common.search')"
              v-model="searchTerm"
              class="form-control"
              style="width: 300px"
            />
          </div>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                class="nav-link active"
                id="home-tab"
                data-toggle="tab"
                href="#home"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >{{ $t("content.pos.home") }}</a
              >
            </li>

            <li
              class="nav-item"
              role="presentation"
              v-for="category in categories"
              :key="category.id"
            >
              <a
                class="nav-link"
                id="profile-tab"
                data-toggle="tab"
                href="#profile"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
                @click="categoryProduct(category.id)"
                >{{ category.category_name }}</a
              >
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="home"
              role="tabpanel"
              aria-labelledby="home-tab"
            >
              <div class="card-body">
                <div class="row">
                  <div
                    class="col-lg-3 col-md-3 col-sm-6 col-6"
                    v-for="item in filtersearch"
                    :key="item.id"
                  >
                    <div
                      class="card"
                      style="align-items: center; margin-bottom: 10px"
                    >
                      <button
                        class="btn btn-sm"
                        :class="disableButton ? 'pointer-events-none' : ''"
                        @click.prevent="
                          addToCart(item.id, item.product_quantity)
                        "
                      >
                        <div class="img-container">
                          <img
                            :src="
                              item.image
                                ? item.image
                                : '/backend/img/none-img.jpg'
                            "
                            class="card-img-top"
                            id="image_size"
                            alt="..."
                          />
                        </div>
                        <div class="card-body">
                          <h5 class="card-title text-center">
                            {{ item.product_name }} -
                            {{ number_format(item.selling_price) }}
                          </h5>
                          <td v-if="item.product_quantity >= 1">
                            <span class="badge badge-success"
                              >{{ $t("common.status_label.available") }}
                              <span class="badge badge-light">{{
                                item.product_quantity
                              }}</span></span
                            >
                          </td>
                          <td v-else>
                            <span class="badge badge-danger">{{
                              $t("common.status_label.stock_out")
                            }}</span>
                          </td>
                        </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="profile"
              role="tabpanel"
              aria-labelledby="profile-tab"
            >
              <div class="card-body">
                <div class="row">
                  <div
                    class="col-lg-3 col-md-3 col-sm-6 col-6"
                    v-for="catProduct in filterCatSearch"
                    :key="catProduct.id"
                  >
                    <div
                      class="card"
                      style="align-items: center; margin-bottom: 10px"
                    >
                      <button
                        class="btn btn-sm"
                        @click.prevent="
                          addToCart(catProduct.id, catProduct.product_quantity)
                        "
                      >
                        <div class="img-container">
                          <img
                            :src="catProduct.image"
                            class="card-img-top"
                            id="image_size"
                            alt="..."
                          />
                        </div>
                        <div class="card-body">
                          <h5 class="card-title text-center">
                            {{ catProduct.product_name }} -
                            {{ number_format(catProduct.selling_price) }}
                          </h5>
                          <td v-if="catProduct.product_quantity >= 1">
                            <span class="badge badge-success"
                              >{{ $t("common.status_label.available") }}
                              <span class="badge badge-light">{{
                                catProduct.product_quantity
                              }}</span></span
                            >
                          </td>
                          <td v-else>
                            <span class="badge badge-danger">{{
                              $t("common.status_label.stock_out")
                            }}</span>
                          </td>
                        </div>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <page-loading v-if="isLoading"></page-loading>
  </div>
</template>


<style lang="css" scoped>
img#image_size {
  max-height: 100px;
  object-fit: contain;
  /* width: auto; */
}
.text-color {
  color: #ffffff;
}
.action {
  font-size: 0.575rem;
}
.pointer-events-none {
  pointer-events: none;
}

/* span.select2-container {
  width: 100%;
} */
</style>
