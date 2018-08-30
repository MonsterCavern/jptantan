<style lang="scss" >
</style>

<template>

<div class="v-gallery">
    <div ref="links" class="lightBoxGallery" @click="openGallery($event, true)"
      v-if="type.toLowerCase() === 'gallery' && $slots.default"
    >
        <slot></slot>
    </div>

    <div class="row light-gallery" ref="innerLinks" v-if="type.toLowerCase() === 'gallery' && !$slots.default">
        <div class="col-md-4" v-for="item in list" :key="item.key">
            <div class="card mb-4 box-shadow">
                <a href="javascript:void(0);" :data-image="item.href" :data-title="item.title">
                    <div class="image-container">
                      <img class="card-img-top" :src="item.thumbnail" alt="item.title">
                    </div>
                </a>
                
                <div class="card-body">
                    <p class="card-text">{{ item.description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary" @click="openGallery($event, false)">View</button>
                        </div>
                        <small class="text-muted">{{ item.updated_at }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div :class="[ctlClass.gallery]" ref="container" id="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title" v-if="controlTitle"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close" v-show="type.toLowerCase() === 'gallery'">×</a>
        <a class="play-pause" v-if="controlPause"></a>
        <ol class="indicator"></ol>
    </div>
</div>

</template>

<script>
import "blueimp-gallery/css/blueimp-gallery.min.css"
import gallery from "blueimp-gallery"
export default {
    name: "v-gallery",
    props: {
        type: {
            type: String,
            default: "gallery"
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
                        "blueimp-gallery": true,
                        "blueimp-gallery-carousel": false,
                        "blueimp-gallery-controls": true,
                        "light-carousel": false
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
        openGallery(e, custom) {
            let that = this
            let target = e.target || e.srcElement,
                    link = target.src ? target.parentNode : target

            if (
                link.className.includes("v-gallery") ||
                link.className.includes("lightBoxGallery") ||
                link.className.includes("light-gallery")
            ) {
                return
            }
            let options = {
                        index: link.closest("a"),
                        event: e,
                        container: that.$refs.container,
                        titleProperty: "title",
                        urlProperty: "image",
                        closeOnSlideClick: false, //點擊非圖片區域，非控制按鈕的空白區域時，是否關閉圖片顯示
                        closeOnSwipeUpOrDown: false, //圖片上下拖動，到屏幕盡頭時，關閉圖片顯示
                        enableKeyboardNavigation: true, //是否打開鍵盤導航
                        toggleControlsOnReturn: false, //是否允許回車，顯示/隱藏控制按鈕
                        toggleControlsOnSlideClick: false, //是否允許鼠標點擊圖片，顯示/隱藏控制按鈕
                        startSlideshow: false, //是否自動開始播放圖片輪播
                        onslide: function(index, slide) {
                            that.showed(index)
                        },
                        onclosed: function() {
                            that.showed(-1)
                        }
                    },
                    main = custom ? that.$refs.links : that.$refs.innerLinks,
                    links = main.getElementsByTagName("a")
            //console.log(e);
            //console.log(link.tagName);

            gallery(links, options)
        },
        openCarousel() {
            if (!this.list.length) {
                return
            }
            let that = this

            this.ctlClass.gallery["blueimp-gallery-carousel"] = true
            this.ctlClass.gallery["light-carousel"] = true
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
            if (typeof idx === "number") {
                this.$emit("showed", idx)
            }
        },
        convert() {
            if (Array.isArray(this.images) && this.images.length) {
                this.list = this.images.concat().map((val, idx) => {
                    return {
                        title: val.title ? val.title : "Image" + (idx + 1),
                        thumbnail: val.thumbnail ? val.thumbnail : val.url,
                        href: val.url
                    }
                })
            }
        },
        closestPolyfill() {
            if (!Element.prototype.matches) {
                Element.prototype.matches =
                    Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector
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
            if (this.type.toLowerCase() === "carousel") {
                this.openCarousel()
            }
        }
    },
    mounted() {
        this.closestPolyfill()
        if (this.type.toLowerCase() === "carousel") {
            this.openCarousel()
        }
    }
}
</script>
