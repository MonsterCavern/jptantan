<style lang="scss" >
.blueimp-gallery > .slides > .slide > .slide-content {
  max-height: 580px !important;
  bottom: 30% !important;
}
.blueimp-card {
  bottom: 30%;
  position: absolute;
  margin-left: 10%;
  margin-right: 10%;
}
</style>

<template>

  <div class="v-gallery">
    <div ref="links" class="lightBoxGallery" @click="openGallery($event, true)" v-if="type.toLowerCase() === 'gallery' && $slots.default">
      <slot></slot>
    </div>

    <div class="row light-gallery" ref="innerLinks" v-if="type.toLowerCase() === 'gallery' && !$slots.default">
      <div class="col-md-4" v-for="(item,index) in list" :key="index">
        <div class="card mb-4 box-shadow">
          <div class="image-container" :data-image="item.href" :data-title="item.title" v-bind="bindAttrData(item)" @click="openGallery($event, false, index)">
            <img class="card-img-top" :src="item.thumbnail" :alt="item.title" style="min-height:580px">
          </div>

          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
              </div>
              <small class="text-muted">{{ item.released_at }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row blueimp-gallery blueimp-gallery-controls" ref="container" id="blueimp-gallery">
      <div class="slides"></div>
      <a class="prev text-white">‹</a>
      <a class="next text-white">›</a>
      <a class="close text-white" v-show="type.toLowerCase() === 'gallery'">×</a>

      <div class="card blueimp-card">
        <h3 class="title" v-if="controlTitle"></h3>

        <div class="card-body">
        </div>
      </div>

      <a class="play-pause" v-if="controlPause"></a>
      <ol class="indicator"></ol>

    </div>
  </div>

</template>

<script>
import 'blueimp-gallery/css/blueimp-gallery.min.css'
import gallery from 'blueimp-gallery'
export default {
  name: 'v-gallery',
  props: {
    type: {
      type: String,
      default: 'gallery'
    },
    images: {
      type: Array,
      required: true
    },
    controlPause: {
      type: Boolean,
      default: false
    },
    controlTitle: {
      type: Boolean,
      default: true
    },
    dark: {
      type: Boolean,
      default: false
    },
    caption: {
      type: Boolean,
      default: false
    },
    ctlClass: {
      type: Object,
      default() {
        return {
          gallery: {
            'blueimp-gallery': true,
            'blueimp-gallery-carousel': false,
            'blueimp-gallery-controls': true,
            'light-carousel': false
          }
        }
      }
    },
    layoutConfig: {
      type: Object,
      default() {
        return {
          title: {
            node: '<h3/>',
            attr: {
              text: 'title'
            }
          },
          description: {
            node: '<p/>',
            attr: {
              text: 'description',
              class: 'text-content'
            }
          }
        }
      }
    }
  },
  data() {
    return {
      list: []
    }
  },
  methods: {
    bindAttrData(item) {
      let result = {}

      for (var key in this.layoutConfig) {
        if (item.hasOwnProperty(key)) {
          result[`data-${key}`] = item[key]
        }
      }

      return result
    },
    openGallery(e, custom, index = 0) {
      let that = this
      let options = {
          index: index,
          event: e,
          container: that.$refs.container,
          titleProperty: 'title',
          urlProperty: 'image',
          closeOnSlideClick: true, //點擊非圖片區域，非控制按鈕的空白區域時，是否關閉圖片顯示
          closeOnSwipeUpOrDown: false, //圖片上下拖動，到屏幕盡頭時，關閉圖片顯示
          enableKeyboardNavigation: true, //是否打開鍵盤導航
          toggleControlsOnReturn: false, //是否允許回車，顯示/隱藏控制按鈕
          toggleControlsOnSlideClick: false, //是否允許鼠標點擊圖片，顯示/隱藏控制按鈕
          startSlideshow: false, //是否自動開始播放圖片輪播
          onslide: function(index, slide) {
            let listData = this.list[index].dataset
            let layoutConfig = $.extend(true, {}, that.layoutConfig)

            for (var key in layoutConfig) {
              let config = layoutConfig[key]

              for (var attr in config.attr) {
                if (listData.hasOwnProperty(config.attr[attr])) {
                  config.attr[attr] = listData[config.attr[attr]]
                }
              }

              if (config.attr.hasOwnProperty('class')) {
                let temp = config.attr.class.split(' ')

                config.attr.class = [key].concat(temp).join(' ')
              } else {
                config.attr.class = key
              }

              let element = $(config.node, config.attr),
                card = this.container.find('.blueimp-card'),
                node = card.find('.' + key)

              if (key == 'title') {
              }

              if (node.length > 0) {
                node[0].parentNode.replaceChild(element[0], node[0])
              } else {
                card.find('.card-body')[0].appendChild(element[0])
              }
            }
            that.showed(index)
          },
          onclosed: function() {
            that.showed(-1)
          }
        },
        main = custom ? that.$refs.links : that.$refs.innerLinks,
        links = main.getElementsByClassName('image-container')

      gallery(links, options)
    },
    openCarousel() {
      if (!this.list.length) {
        return
      }
      let that = this

      this.ctlClass.gallery['blueimp-gallery-carousel'] = true
      this.ctlClass.gallery['light-carousel'] = true
      this.$nextTick(() => {
        let a = gallery(that.list, {
          container: that.$refs.container,
          carousel: true,
          toggleControlsOnSlideClick: false,
          onslide: function(index, slide) {
            that.showed(index)
          }
        })
      })
    },
    showed(idx) {
      if (typeof idx === 'number') {
        this.$emit('showed', idx)
      }
    },
    convert() {
      if (Array.isArray(this.images) && this.images.length) {
        this.list = this.images.concat().map((val, idx) => {
          let result = {
            title: val.title ? val.title : 'Image' + (idx + 1),
            thumbnail: val.thumbnail ? val.thumbnail : val.image,
            href: val.image
          }

          return $.extend(true, val, result)
        })
      }
    },
    closestPolyfill() {
      if (!Element.prototype.matches) {
        Element.prototype.matches =
          Element.prototype.msMatchesSelector ||
          Element.prototype.webkitMatchesSelector
      }

      if (!Element.prototype.closest) {
        Element.prototype.closest = function(s) {
          var el = this

          if (!document.documentElement.contains(el)) {
            return null
          }
          do {
            if (el.matches(s)) {
              return el
            }
            el = el.parentElement || el.parentNode
          } while (el !== null && el.nodeType === 1)
          return null
        }
      }
    }
  },
  beforeMount() {
    this.convert()
  },
  watch: {
    images() {
      this.convert()
      if (this.type.toLowerCase() === 'carousel') {
        this.openCarousel()
      }
    }
  },
  mounted() {
    this.closestPolyfill()
    if (this.type.toLowerCase() === 'carousel') {
      this.openCarousel()
    }
  }
}
</script>
