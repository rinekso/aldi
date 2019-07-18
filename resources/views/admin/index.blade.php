<?php $title = 'home';?>
@extends('admin.layout')
@section('css')
    <!-- jQuery custom content scroller -->
    <link href="/assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box-contain">
        <div class="box-header">
          Status SPP
          <div class="clearfix"></div>
        </div>
        <div class="box-body">

          <div id="echart_pie" style="height:350px;"></div>

          <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalBelum">Belum Bayar</button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box-contain">
        <div class="box-header">
          Status UTS
          <div class="clearfix"></div>
        </div>
        <div class="box-body">

          <div id="echart_pie2" style="height:350px;"></div>

          <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalBelum">Belum Bayar</button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box-contain">
        <div class="box-header">
          Status UAS
          <div class="clearfix"></div>
        </div>
        <div class="box-body">

          <div id="echart_pie3" style="height:350px;"></div>

          <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalBelum">Belum Bayar</button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box-contain">
        <div class="box-header">
          Status Kalender
          <div class="clearfix"></div>
        </div>
        <div class="box-body">

          <div id="echart_pie4" style="height:350px;"></div>

          <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modalBelum">Belum Bayar</button>
        </div>
      </div>
    </div>
		<div class="col-md-6">
			<div class="box-contain">
				<div class="box-header">
					Topup per tahun
				</div>
				<div class="box-body">
          <div id="echart_line" style="height:350px;"></div>          
<!--           <h1 style="text-align: center;">Welcome Admin</h1>
          <img src="{{url('/assets/images/logo.jpg')}}" width="200" style="margin: auto; display: block;"> -->
				</div>
			</div>
		</div>
<div id="modalBelum" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Daftar Siswa Yang Belum Bayar</h4>
      </div>
      <div class="modal-body">
              <table id="datatable-responsive" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($siswa as $s)
                  <tr>
                    <td>{{$s->nik}}</td>
                    <td>{{$s->nama}}</td>
                    <td>{{$s->kelas->tingkat}}/{{$s->jenjang->nama_jenjang}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection
@section('js')
<!--[if !(gte IE 8)]><!-->
<script src="/assets/js/wow.min.js"></script>
<script>
    // Initialize WOW
    //-------------------------------------------------------------
    new WOW({mobile: false}).init();
</script>
<!--<![endif]-->
<!-- ECharts -->
<script src="/assets/plugins/echarts/dist/echarts.min.js"></script>
<!-- jQuery custom content scroller -->
<script src="/assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- <script src="/admin/assets/js/custom.js"></script> -->
<script>
$(document).ready(function(){
        //echart
      var theme = {
          color: [
              '#00a2e9', '#18314c', '#BDC3C7', '#3498DB',
              '#5962b6', '#6fb8bb', '#6a929c', '#b7d1d3'
          ],

          title: {
              itemGap: 8,
              textStyle: {
                  fontWeight: 'normal',
                  color: '#18314c'
              }
          },

          dataRange: {
              color: ['#1f610a', '#97b58d']
          },

          toolbox: {
              color: ['#408829', '#408829', '#408829', '#408829']
          },

          tooltip: {
              backgroundColor: 'rgba(0,0,0,0.5)',
              axisPointer: {
                  type: 'line',
                  lineStyle: {
                      color: '#408829',
                      type: 'dashed'
                  },
                  crossStyle: {
                      color: '#408829'
                  },
                  shadowStyle: {
                      color: 'rgba(200,200,200,0.3)'
                  }
              }
          },

          dataZoom: {
              dataBackgroundColor: '#eee',
              fillerColor: 'rgba(64,136,41,0.2)',
              handleColor: '#408829'
          },
          grid: {
              borderWidth: 0
          },

          categoryAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },

          valueAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitArea: {
                  show: true,
                  areaStyle: {
                      color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },
          timeline: {
              lineStyle: {
                  color: '#408829'
              },
              controlStyle: {
                  normal: {color: '#408829'},
                  emphasis: {color: '#408829'}
              }
          },

          k: {
              itemStyle: {
                  normal: {
                      color: '#68a54a',
                      color0: '#a9cba2',
                      lineStyle: {
                          width: 1,
                          color: '#408829',
                          color0: '#86b379'
                      }
                  }
              }
          },
          map: {
              itemStyle: {
                  normal: {
                      areaStyle: {
                          color: '#ddd'
                      },
                      label: {
                          textStyle: {
                              color: '#c12e34'
                          }
                      }
                  },
                  emphasis: {
                      areaStyle: {
                          color: '#99d2dd'
                      },
                      label: {
                          textStyle: {
                              color: '#c12e34'
                          }
                      }
                  }
              }
          },
          force: {
              itemStyle: {
                  normal: {
                      linkStyle: {
                          strokeColor: '#408829'
                      }
                  }
              }
          },
          chord: {
              padding: 4,
              itemStyle: {
                  normal: {
                      lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                          lineStyle: {
                              width: 1,
                              color: 'rgba(128, 128, 128, 0.5)'
                          }
                      }
                  },
                  emphasis: {
                      lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                          lineStyle: {
                              width: 1,
                              color: 'rgba(128, 128, 128, 0.5)'
                          }
                      }
                  }
              }
          },
          gauge: {
              startAngle: 225,
              endAngle: -45,
              axisLine: {
                  show: true,
                  lineStyle: {
                      color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                      width: 8
                  }
              },
              axisTick: {
                  splitNumber: 10,
                  length: 12,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              axisLabel: {
                  textStyle: {
                      color: 'auto'
                  }
              },
              splitLine: {
                  length: 18,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              pointer: {
                  length: '90%',
                  color: 'auto'
              },
              title: {
                  textStyle: {
                      color: '#333'
                  }
              },
              detail: {
                  textStyle: {
                      color: 'auto'
                  }
              }
          },
          textStyle: {
              fontFamily: 'Arial, Verdana, sans-serif'
          }
      };
      var echartPie = echarts.init(document.getElementById('echart_pie'), theme);
      var echartPie2 = echarts.init(document.getElementById('echart_pie2'), theme);
      var echartPie3 = echarts.init(document.getElementById('echart_pie3'), theme);
      var echartPie4 = echarts.init(document.getElementById('echart_pie4'), theme);

      echartPie.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['Belum Bayar', 'Sudah Bayar']
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name: 'Most Seen',
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          data: [{
            value: 1000,
            name: 'Belum Bayar'
          }, {
            value: 500,
            name: 'Sudah Bayar'
          }]
        }]
      });
      echartPie2.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['Belum Bayar', 'Sudah Bayar']
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name: 'Most Seen',
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          data: [{
            value: 1000,
            name: 'Belum Bayar'
          }, {
            value: 500,
            name: 'Sudah Bayar'
          }]
        }]
      });
      echartPie3.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['Belum Bayar', 'Sudah Bayar']
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name: 'Most Seen',
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          data: [{
            value: 1000,
            name: 'Belum Bayar'
          }, {
            value: 500,
            name: 'Sudah Bayar'
          }]
        }]
      });
      echartPie4.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['Belum Bayar', 'Sudah Bayar']
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              type: ['pie', 'funnel'],
              option: {
                funnel: {
                  x: '25%',
                  width: '50%',
                  funnelAlign: 'left',
                  max: 1548
                }
              }
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        series: [{
          name: 'Most Seen',
          type: 'pie',
          radius: '55%',
          center: ['50%', '48%'],
          data: [{
            value: 1000,
            name: 'Belum Bayar'
          }, {
            value: 500,
            name: 'Sudah Bayar'
          }]
        }]
      });

      var echartLine = echarts.init(document.getElementById('echart_line'), theme);

      echartLine.setOption({
        title: {
          text: '',
          subtitle: 'Topup',
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          x: 220,
          y: 40,
          data: ['Topup']
        },
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              title: {
                line: 'Line',
                bar: 'Bar',
              },
              type: ['line', 'bar']
            },
            restore: {
              show: true,
              title: "Restore"
            },
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des']
        }],
        yAxis: [{
          type: 'value'
        }],
        series: [{
          name: 'Topup',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: [1002, 1221, 2341, 5344, 2360, 1830, 2710]
        }]
      });

      // var echartPie = echarts.init(document.getElementById('echart_pie'), theme);
      // echartPie.setOption({
      //   tooltip: {
      //     trigger: 'item',
      //     formatter: "{a} <br/>{b} : {c} ({d}%)"
      //   },
      //   legend: {
      //     x: 'center',
      //     y: 'bottom',
      //     data: ['Berita', 'Profil Perusahaan', 'Info Investor', 'Layanan']
      //   },
      //   toolbox: {
      //     show: true,
      //     feature: {
      //       magicType: {
      //         show: true,
      //         type: ['pie', 'funnel'],
      //         option: {
      //           funnel: {
      //             x: '25%',
      //             width: '50%',
      //             funnelAlign: 'left',
      //             max: 1548
      //           }
      //         }
      //       },
      //       restore: {
      //         show: true,
      //         title: "Restore"
      //       },
      //       saveAsImage: {
      //         show: true,
      //         title: "Save Image"
      //       }
      //     }
      //   },
      //   calculable: true,
      //   series: [{
      //     name: 'Most Seen',
      //     type: 'pie',
      //     radius: '55%',
      //     center: ['50%', '48%'],
      //     data: [{
      //       value: 1000,
      //       name: 'Berita'
      //     }, {
      //       value: 500,
      //       name: 'Profil Perusahaan'
      //     }, {
      //       value: 234,
      //       name: 'Investor'
      //     }, {
      //       value: 345,
      //       name: 'Layanan'
      //     }]
      //   }]
      // });

});
</script>

@endsection