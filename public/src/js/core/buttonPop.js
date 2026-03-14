export function buttonPop (){

  const tooltip = document.getElementById("tooltip");

  document.addEventListener("mousemove", (e) => {

    const btn = e.target.closest(".action-btn");

    if (!btn) {
      tooltip.style.opacity = 0;
      return;
    }

    tooltip.textContent = btn.dataset.tooltip;
    tooltip.style.opacity = 1;
    tooltip.style.left = e.clientX + 12 + "px";
    tooltip.style.top = e.clientY - 20 + "px";

  });

};