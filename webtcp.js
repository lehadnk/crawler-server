/**
 * Created by lehadnk on 24/03/2017.
 */
var WebTCP = require('./lib/webtcp/lib/server/webtcp.js').WebTCP;

var server = new WebTCP();
server.listen(9999, "127.0.0.1");