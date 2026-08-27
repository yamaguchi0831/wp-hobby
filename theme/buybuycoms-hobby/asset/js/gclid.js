(() => {
  "use strict";

  const cookieName = "buybuycoms_hobby_gclid";
  const maxAge = 90 * 24 * 60 * 60;

  const getCookie = (name) => {
    const prefix = `${name}=`;
    const cookie = document.cookie
      .split(";")
      .map((value) => value.trim())
      .find((value) => value.startsWith(prefix));

    if (!cookie) {
      return "";
    }

    try {
      return decodeURIComponent(cookie.slice(prefix.length));
    } catch {
      return "";
    }
  };

  const gclid = new URLSearchParams(window.location.search).get("gclid");

  if (gclid) {
    const secure = window.location.protocol === "https:" ? "; Secure" : "";
    document.cookie = `${cookieName}=${encodeURIComponent(gclid)}; Max-Age=${maxAge}; Path=/; SameSite=Lax${secure}`;
  }

  const storedGclid = getCookie(cookieName);
  document.querySelectorAll('input[name="gclid"]').forEach((field) => {
    field.value = storedGclid;
  });
})();
