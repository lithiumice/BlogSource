---
title: docker command translation
url: 150.html
id: 150
categories:
  - 翻译Wiki
date: 2019-09-08 22:06:28
tags:
---
## tips
docker ps -a --no-trunc 查看正在运行的容器是通过什么命令启动的：
-f: 让 docker logs 像使用 tail -f 一样来输出容器内部的标准输出。
-d:让容器在后台运行。
-P:将容器内部使用的网络端口映射到我们使用的主机上。
-f: 让 docker logs 像使用 tail -f 一样来输出容器内部的标准输出。
-d:让容器在后台运行。
-P:将容器内部使用的网络端口映射到我们使用的主机上。
docker attach --sig-proxy=false mynginx
-f :通过SIGKILL信号强制删除一个运行中的容器
-l :移除容器间的网络连接，而非容器本身
-v :-v 删除与容器关联的卷
-d :分离模式: 在后台运行
-i :即使没有附加也保持STDIN 打开
-t :分配一个伪终端
## useful command
```
  docker run -d -p 5000:5000 training/webapp python app.py
  docker logs -f bf08b7f2cd89(ID)
  docker run -it ubuntu:15.10 /bin/bash
  docker top wizardly_chandrasekhar
  docker inspect wizardly_chandrasekhar
  docker ps -l 查询最后一次创建的容器
  docker images //like list images
  docker commit -m=&quot;has update&quot; -a=&quot;author&quot; ID runoob/ubuntu:v2
  docker top wizardly_chandrasekhar
  docker inspect wizardly_chandrasekhar
  docker run -d -p 5000:5000 training/webapp python app.py
  docker logs -f bf08b7f2cd89(ID)
  docker run -it ubuntu:15.10 /bin/bash
  docker exec -it mynginx /bin/sh /root/runoob.sh

```

## main command
```
  attach    Attach to a running container //连接到一个正在运行的容器
  build     Build an image from a Dockerfile //构建一个镜像
  commit    Create a new image from a container's changes //更新镜像
  cp        Copy files/folders between a container and the local filesystem //复制
  create    Create a new container
  diff      Inspect changes on a container's filesystem //检查容器文件系统的变化
  events    Get real time events from the server
  exec      Run a command in a running container//在容器中运行命令
  export    Export a container's filesystem as a tar archive //以tar格式导出容器系统
  history   Show the history of an image //历史
  images    List images
  import    Import the contents from a tarball to create a filesystem image //于export相反
  info      Display system-wide information //显示主机信息
  inspect   Return low-level information on a container, image or task
  kill      Kill one or more ru
  attach    Attach to a running container //连接到一个正在运行的容器
  build     Build an image from a Dockerfile //构建一个镜像
  commit    Create a new image from a container's changes //更新镜像
  cp        Copy files/folders between a container and the local filesystem //复制
  create    Create a new container
  diff      Inspect changes on a container's filesystem //检查容器文件系统的变化
  events    Get real time events from the server
  exec      Run a command in a running container//在容器中运行命令
  export    Export a container's filesystem as a tar archive //以tar格式导出容器系统
  history   Show the history of an image //历史
  images    List images
  import    Import the contentsnning containers //杀死
  load      Load an image from a tar archive or STDIN //加载文件系统
  login     Log in to a Docker registry. //登录docker.org
  logout    Log out from a Docker registry.
  logs      Fetch the logs of a container
  network   Manage Docker networks
  node      Manage Docker Swarm nodes //docker集群
  pause     Pause all processes within one or more containers //暂停
  port      List port mappings or a specific mapping for the container //显示容器端口映射
  ps        List containers
  pull      Pull an image or a repository from a registry
  push      Push an image or a repository to a registry
  rename    Rename a container
  restart   Restart a container
  rm        Remove one or more containers
  rmi       Remove one or more images
  run       Run a command in a new container
  save      Save one or more images to a tar archive (streamed to STDOUT by default)
  search    Search the Docker Hub for images
  service   Manage Docker services
  start     Start one or more stopped containers
  stats     Display a live stream of container(s) resource usage statistics
  stop      Stop one or more running containers
  swarm     Manage Docker Swarm
  tag       Tag an image into a repository
  top       Display the running processes of a container //在容器中运行top
  unpause   Unpause all processes within one or more containers
  update    Update configuration of one or more containers
  version   Show the Docker version information
  volume    Manage Docker volumes
  wait      Block until a container stops, then print its exit code
```


## subcommand
```
    --add-host value              Add a custom host-to-IP mapping (host:ip) (default [])
    -a, --attach value                Attach to STDIN, STDOUT or STDERR (default [])
    --blkio-weight value          Block IO (relative weight), between 10 and 1000
    --blkio-weight-device value   Block IO weight (relative device weight) (default [])
    --cap-add value               Add Linux capabilities (default [])
    --cap-drop value              Drop Linux capabilities (default [])
    --cgroup-parent string        Optional parent cgroup for the container
    --cidfile string              Write the container ID to the file
    --cpu-percent int             CPU percent (Windows only)
    --cpu-period int              Limit CPU CFS (Completely Fair Scheduler) period
    --cpu-quota int               Limit CPU CFS (Completely Fair Scheduler) quota
-c, --cpu-shares int              CPU shares (relative weight)
    --cpuset-cpus string          CPUs in which to allow execution (0-3, 0,1)
    --cpuset-mems string          MEMs in which to allow execution (0-3, 0,1)
-d, --detach                      Run container in background and print container ID
    --detach-keys string          Override the key sequence for detaching a container
    --device value                Add a host device to the container (default [])
    --device-read-bps value       Limit read rate (bytes per second) from a device (default [])
    --device-read-iops value      Limit read rate (IO per second) from a device (default [])
    --device-write-bps value      Limit write rate (bytes per second) to a device (default [])
    --device-write-iops value     Limit write rate (IO per second) to a device (default [])
    --disable-content-trust       Skip image verification (default true)
    --dns value                   Set custom DNS servers (default [])
    --dns-opt value               Set DNS options (default [])
    --dns-search value            Set custom DNS search domains (default [])
    --entrypoint string           Overwrite the default ENTRYPOINT of the image
-e, --env value                   Set environment variables (default [])
    --env-file value              Read in a file of environment variables (default [])
    --expose value                Expose a port or a range of ports (default [])
    --group-add value             Add additional groups to join (default [])
    --health-cmd string           Command to run to check health
    --health-interval duration    Time between running the check
    --health-retries int          Consecutive failures needed to report unhealthy
    --health-timeout duration     Maximum time to allow one check to run
    --help                        Print usage
-h, --hostname string             Container host name
-i, --interactive                 Keep STDIN open even if not attached
    --io-maxbandwidth string      Maximum IO bandwidth limit for the system drive (Windows only)
    --io-maxiops uint             Maximum IOps limit for the system drive (Windows only)
    --ip string                   Container IPv4 address (e.g. 172.30.100.104)
    --ip6 string                  Container IPv6 address (e.g. 2001:db8::33)
    --ipc string                  IPC namespace to use
    --isolation string            Container isolation technology
    --kernel-memory string        Kernel memory limit
-l, --label value                 Set meta data on a container (default [])
    --label-file value            Read in a line delimited file of labels (default [])
    --link value                  Add link to another container (default [])
    --link-local-ip value         Container IPv4/IPv6 link-local addresses (default [])
    --log-driver string           Logging driver for the container
    --log-opt value               Log driver options (default [])
    --mac-address string          Container MAC address (e.g. 92:d0:c6:0a:29:33)
-m, --memory string               Memory limit
    --memory-reservation string   Memory soft limit
    --memory-swap string          Swap limit equal to memory plus swap: '-1' to enable unlimited swap
    --memory-swappiness int       Tune container memory swappiness (0 to 100) (default -1)
    --name string                 Assign a name to the container
    --network string              Connect a container to a network (default &quot;default&quot;)
    --network-alias value         Add network-scoped alias for the container (default [])
    --no-healthcheck              Disable any container-specified HEALTHCHECK
    --oom-kill-disable            Disable OOM Killer
    --oom-score-adj int           Tune host's OOM preferences (-1000 to 1000)
    --pid string                  PID namespace to use
    --pids-limit int              Tune container pids limit (set -1 for unlimited)
    --privileged                  Give extended privileges to this container
-p, --publish value               Publish a container's port(s) to the host (default [])
-P, --publish-all                 Publish all exposed ports to random ports
    --read-only                   Mount the container's root filesystem as read only
    --restart string              Restart policy to apply when a container exits (default &quot;no&quot;)
    --rm                          Automatically remove the container when it exits
    --runtime string              Runtime to use for this container
    --security-opt value          Security Options (default [])
    --shm-size string             Size of /dev/shm, default value is 64MB
    --sig-proxy                   Proxy received signals to the process (default true)
    --stop-signal string          Signal to stop a container, 15 by default (default &quot;15&quot;)
    --storage-opt value           Storage driver options for the container (default [])
    --sysctl value                Sysctl options (default map[])
    --tmpfs value                 Mount a tmpfs directory (default [])
-t, --tty                         Allocate a pseudo-TTY
    --ulimit value                Ulimit options (default [])
-u, --user string                 Username or UID (format: &lt;name|uid&gt;[:&lt;group|gid&gt;])
    --userns string               User namespace to use
    --uts string                  UTS namespace to use
-v, --volume value                Bind mount a volume (default [])
    --volume-driver string        Optional volume driver for the container
    --volumes-from value          Mount volumes from the specified container(s) (default [])
-w, --workdir string              Working directory inside the container
```
