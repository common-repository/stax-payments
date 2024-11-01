(() => {
  const buttons = Array.from(
    document.querySelectorAll(".stax-payments-button")
  );

  if (!buttons.length) return;

  buttons.forEach((button) =>
    button.addEventListener("click", () => CardX.pay_with_cardx())
  );
})();
