<template>
    <div class="rounded border border-neutral-300/70 bg-neutral-100">
        <div v-if="editor" class="toolbar">
            <!-- Bold -->
            <AppButton
                v-tooltip="{ content: __('Bold') }"
                :class="{ 'is-active': editor.isActive('bold') }"
                @click="editor.chain().focus().toggleBold().run()"
            >
                <McBoldFill />
            </AppButton>
            <!-- Bold -->

            <!-- Italic -->
            <AppButton
                v-tooltip="{ content: __('Italic') }"
                :class="{ 'is-active': editor.isActive('italic') }"
                @click="editor.chain().focus().toggleItalic().run()"
            >
                <McItalicFill />
            </AppButton>
            <!-- Italic -->

            <!-- Strike -->
            <AppButton
                v-tooltip="{ content: __('Strike') }"
                :class="{ 'is-active': editor.isActive('strike') }"
                @click="editor.chain().focus().toggleStrike().run()"
            >
                <McStrikethroughFill />
            </AppButton>
            <!-- Strike -->

            <!-- Underline -->
            <AppButton
                v-tooltip="{ content: __('Underline') }"
                :class="{ 'is-active': editor.isActive('underline') }"
                @click="editor.chain().focus().toggleUnderline().run()"
            >
                <McUnderlineFill />
            </AppButton>
            <!-- Underline -->

            <!-- Align -->
            <div class="ml-1 inline-flex border-l border-neutral-300/70 ps-1">
                <AppButton
                    v-tooltip="{ content: __('Align Left') }"
                    :class="{
                        'is-active': editor.isActive({ textAlign: 'left' })
                    }"
                    @click="editor.chain().focus().setTextAlign('left').run()"
                >
                    <McAlignLeftFill />
                </AppButton>
                <AppButton
                    v-tooltip="{ content: __('Align Center') }"
                    :class="{
                        'is-active': editor.isActive({ textAlign: 'center' })
                    }"
                    @click="editor.chain().focus().setTextAlign('center').run()"
                >
                    <McAlignCenterFill />
                </AppButton>
                <AppButton
                    v-tooltip="{ content: __('Align Right') }"
                    :class="{
                        'is-active': editor.isActive({ textAlign: 'right' })
                    }"
                    @click="editor.chain().focus().setTextAlign('right').run()"
                >
                    <McAlignRightFill />
                </AppButton>
                <AppButton
                    v-tooltip="{ content: __('Justify') }"
                    :class="{
                        'is-active': editor.isActive({ textAlign: 'justify' })
                    }"
                    @click="
                        editor.chain().focus().setTextAlign('justify').run()
                    "
                >
                    <McAlignJustifyFill />
                </AppButton>
            </div>
            <!-- Align -->

            <!-- List -->
            <div
                class="me-1 ml-1 inline-flex border-l border-r border-neutral-300/70 pe-1 ps-1"
            >
                <AppButton
                    v-tooltip="{ content: __('Unordered List') }"
                    :class="{ 'is-active': editor.isActive('bulletList') }"
                    @click="editor.chain().focus().toggleBulletList().run()"
                >
                    <McListCheckFill />
                </AppButton>
                <AppButton
                    v-tooltip="{ content: __('Ordered List') }"
                    :class="{ 'is-active': editor.isActive('orderedList') }"
                    @click="editor.chain().focus().toggleOrderedList().run()"
                >
                    <McListOrderedLine />
                </AppButton>
            </div>
            <!-- List -->

            <!-- Blockquote -->
            <AppButton
                v-tooltip="{ content: __('Blockquote') }"
                :class="{ 'is-active': editor.isActive('blockquote') }"
                @click="editor.chain().focus().toggleBlockquote().run()"
            >
                <McQuoteRightFill />
            </AppButton>
            <!-- Blockquote -->

            <!-- codeblock -->
            <AppButton
                v-tooltip="{ content: __('Code Block') }"
                :class="{ 'is-active': editor.isActive('codeBlock') }"
                @click="editor.chain().focus().toggleCodeBlock().run()"
            >
                <McCodeFill />
            </AppButton>
            <!-- codeblock -->

            <!-- history -->
            <div class="ml-1 inline-flex border-l border-neutral-300/70 ps-1">
                <AppButton
                    v-tooltip="{ content: __('Undo') }"
                    :disabled="!editor.can().undo()"
                    @click="editor.chain().focus().undo().run()"
                >
                    <McBackFill />
                </AppButton>
                <AppButton
                    v-tooltip="{ content: __('Redo') }"
                    :disabled="!editor.can().redo()"
                    @click="editor.chain().focus().redo().run()"
                >
                    <McForwardFill />
                </AppButton>
            </div>
            <!-- history -->

            <!-- clear -->
            <AppButton
                v-tooltip="{ content: __('Clear Formatting') }"
                class="sm:float-right"
                @click="clear"
            >
                <FlFilledClearFormatting />
            </AppButton>
            <!-- clear -->
        </div>
        <div class="relative">
            <editor-content v-if="editor" :editor="editor" />
        </div>
    </div>
</template>
<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3';
import { Placeholder } from '@tiptap/extension-placeholder';
import { Underline } from '@tiptap/extension-underline';
import { TextAlign } from '@tiptap/extension-text-align';
import StarterKit from '@tiptap/starter-kit';
import AppButton from '@Components/Form/AppButton.vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: null
    }
});

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    editorProps: {
        attributes: {
            class: 'prose prose-xs text-sm sm:prose-sm lg:prose-sm xl:prose-sm m-1 focus:outline-none'
        }
    },
    extensions: [
        StarterKit.configure({
            history: {
                depth: 20
            }
        }),
        Placeholder.configure({
            placeholder: props.placeholder
        }),
        TextAlign.configure({
            types: ['heading', 'paragraph']
        }),
        Underline
    ],
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML());
    }
});

const clear = () => {
    editor.value.chain().focus().clearNodes().run();
    editor.value.chain().focus().unsetAllMarks().run();
};
</script>
<style lang="scss">
.ProseMirror {
    @apply block h-full min-h-[5rem] w-full px-3 py-3 text-sm;
    p.is-editor-empty:first-child::before {
        content: attr(data-placeholder);
        float: left;
        height: 0;
        pointer-events: none;
        @apply w-full text-sm font-normal text-neutral-400/80;
    }
}
.toolbar {
    @apply block border-b border-neutral-300/70 bg-neutral-200/25 px-1 pb-0.5 pt-1.5;
    button {
        @apply rounded px-1 py-1 text-gray-500 transition duration-150 hover:bg-neutral-400/25 hover:text-gray-800;
        svg {
            @apply h-5 w-5;
        }
    }
}
</style>
