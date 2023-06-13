// Toggle class active untuk hamburger menu
const navbarNav = document.querySelector('.navbar-nav');

// Ketika hamburger di klik
document.querySelector('#hamburger-menu').onclick = () => {
  navbarNav.classList.toggle('active');
};

// Toggle class active untuk search form
const searchForm = document.querySelector('.search-form');
const searchBox = document.querySelector('#search-box');

document.querySelector('#search-button').onclick = (e) => {
  searchForm.classList.toggle('active');
  searchBox.focus();
  e.preventDefault();
};

// Toggle class shopping cart
const shoppingCart = document.querySelector('.cart');
let cartIcon = document.querySelector('#shopping-cart-button');
let cart = document.querySelector('.cart');
let cartClose = document.querySelector('#close-cart');

cartIcon.onclick = () => {
  cart.classList.toggle('active');
};

cartClose.onclick = () => {
  cart.classList.remove('active');
};

// Cart Working
if (document.readyState == 'loading') {
  document.addEventListener('DOMContentLoaded', ready);
} else {
  ready();
}

// Making Function
function ready() {
  // Remove Item From Cart
  var removeCartButton = document.getElementsByClassName('cart-remove');
  console.log(removeCartButton);
  for (var i = 0; i < removeCartButton.length; i++) {
    var button = removeCartButton[i];
    button.addEventListener('click', removeCartItem);
  }
  // Quantity Changes
  var quantityInputs = document.getElementsByClassName('cart-quantity');
  for (var i = 0; i < quantityInputs.length; i++) {
    var input = quantityInputs[i];
    input.addEventListener('change', quantityChanged);
  }
  // Add To Cart
  var addCart = document.getElementsByClassName('card-btn');
  for (var i = 0; i < addCart.length; i++) {
    var button = addCart[i];
    button.addEventListener('click', addCartClicked);
  }
  // Buy Button work
  document.getElementsByClassName('btn-buy')[0].addEventListener('click', buyButtonClicked);
}

// Buy Button
function buyButtonClicked() {
  alert('Yout Order is Placed');
  var cartContent = document.getElementsByClassName('cart-content')[0];
  while (cartContent.hasChildNodes()) {
    cartContent.removeChild(cartContent.firstChild);
  }
  updatetotal();
}

// Remove Items From Cart
function removeCartItem(event) {
  var buttonClicked = event.target;
  buttonClicked.parentElement.remove();
  updatetotal();
}

// Quantity Changes
function quantityChanged(event) {
  var input = event.target;
  if (isNaN(input.value) || input.value <= 0) {
    input.value = 1;
  }
  updatetotal();
}

// Add To Cart
function addCartClicked(event) {
  var button = event.target;
  var shopProducts = button.parentElement;
  var title = shopProducts.getElementsByClassName('product-baju-pria')[0].innerText;
  var price = shopProducts.getElementsByClassName('price')[0].innerText;
  var productImg = shopProducts.getElementsByClassName('product-thumb')[0].src;
  addProductToCart(title, price, productImg);
  updatetotal();
}

function addProductToCart(title, price, productImg) {
  var cartShopBox = document.createElement('div');
  cartShopBox.classList.add('cart-box');
  var cartItems = document.getElementsByClassName('cart-content')[0];
  var cartItemsNames = cartItems.getElementsByClassName('cart-product-title');
  for (var i = 0; i < cartItemsNames.length; i++) {
    if (cartItemsNames[i].innerHTML == title) {
      alert('You have already add this item to cart');
      return;
    }
  }
  var cartBoxContent = `
                <img src="${productImg}" alt="" class="cart-img">
                <div class="detail-box">
                    <div class="cart-product-title">${title}</div>
                    <div class="cart-price">${price}</div>
                    <input type="number" value="1" class="cart-quantity">
                </div>
                <i data-feather="trash" class="cart-remove"></i>`;
  cartShopBox.innerHTML = cartBoxContent;
  cartItems.append(cartShopBox);
  cartShopBox.getElementsByClassName('cart-remove')[0].addEventListener('click', removeCartItem);
  cartShopBox.getElementsByClassName('cart-quantity')[0].addEventListener('change', quantityChanged);
}

// Update Total
function updatetotal() {
  var cartContent = document.getElementsByClassName('cart-content')[0];
  var cartBoxes = cartContent.getElementsByClassName('cart-box');
  var total = 0;
  for (var i = 0; i < cartBoxes.length; i++) {
    var cartBox = cartBoxes[i];
    var priceElement = cartBox.getElementsByClassName('cart-price')[0];
    var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];
    var price = parseFloat(priceElement.innerText.replace('$', ''));
    var quantity = quantityElement.value;
    total = total + price * quantity;
  }
  // If price Contain some Cents value
  total = Math.round(total * 100) / 100;

  document.getElementsByClassName('total-price')[0].innerText = '$' + total;
}

// Klik di luar elemen
const hm = document.querySelector('#hamburger-menu');
const sb = document.querySelector('#search-button');
const sc = document.querySelector('#shopping-cart-button');

document.addEventListener('click', function (e) {
  if (!hm.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove('active');
  }

  if (!sb.contains(e.target) && !searchForm.contains(e.target)) {
    searchForm.classList.remove('active');
  }

  if (!sc.contains(e.target) && !shoppingCart.contains(e.target)) {
    shoppingCart.classList.remove('active');
  }
});

// Button Product
const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
  let containerDimenstions = item.getBoundingClientRect();
  let containerWidth = containerDimenstions.width;

  nxtBtn[i].addEventListener('click', () => {
    item.scrollLeft += containerWidth;
  });

  preBtn[i].addEventListener('click', () => {
    item.scrollLeft -= containerWidth;
  });
});
