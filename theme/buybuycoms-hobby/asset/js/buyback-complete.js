(() => {
  "use strict";

  const conversion = window.buybuycomsHobbyConversion;

  if (!conversion || !conversion.buybackMethod) {
    return;
  }

  window.dataLayer = window.dataLayer || [];
  window.dataLayer.push({
    event: "buyback_complete",
    buyback_method: conversion.buybackMethod,
  });

  delete window.buybuycomsHobbyConversion;
})();
