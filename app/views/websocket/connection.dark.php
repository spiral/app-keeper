<stack:push name="scripts" unique-id="websockets">
    <script src="https://cdn.jsdelivr.net/gh/spiral/websockets/build/socket.js"></script>
    <script type="text/javascript">
        var Socket = SFSocket.SFSocket;
        var SpiralSocketConnection = new Socket({ host: window.location.host });
    </script>
</stack:push>
