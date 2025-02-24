const Ziggy = {"url":"http:\/\/localhost:8000","port":8000,"defaults":{},"routes":{"sanctum.csrf-cookie":{"uri":"sanctum\/csrf-cookie","methods":["GET","HEAD"]},"ignition.healthCheck":{"uri":"_ignition\/health-check","methods":["GET","HEAD"]},"ignition.executeSolution":{"uri":"_ignition\/execute-solution","methods":["POST"]},"ignition.updateConfig":{"uri":"_ignition\/update-config","methods":["POST"]},"articles":{"uri":"\/","methods":["GET","HEAD"]},"articles.create":{"uri":"articles\/create","methods":["GET","HEAD"]},"articles.store":{"uri":"articles","methods":["POST"]},"articles.edit":{"uri":"articles\/edit\/{article}","methods":["GET","HEAD"],"parameters":["article"],"bindings":{"article":"id"}}}};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
  Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
