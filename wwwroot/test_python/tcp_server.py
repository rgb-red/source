import socket

sockfd = socket.socket(socket.AF_INET, socket.SOCK_STREAM) # 创建套接字
sockfd.bind(('0.0.0.0', 65500)) # 绑定地址
sockfd.listen(3) # 设置监听．linux此参数无用，系统自行维护队列

while True:
	print("waitting for connect...")
	connfd, addr = sockfd.accept() # 客户端连接．connfd客户端套接字 addr客户端地址．会阻塞
	print("connect from", addr)
	
	while True:
	    data = connfd.recv(1024) # buffersize 一次接收多少字节
	    if data == b"exit" or not data: # 如果客户端直接退出，服务端会接收到客户端已经断开，停止阻塞，返回空
	        break                       # 这时候打印出接空后程序不结束的话，会向客户端发送数据，
	    print("recive:", data.decode()) # 这时候就会报错＂broken pipe error＂
	
	    n = connfd.send(b"thanks")  #接收发送都是字节串
	    print("send message size:", n)
	connfd.close()

sockfd.close()