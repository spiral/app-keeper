<div
    title="${title}"
    data-id="${id}"
    data-piece="background"
    data-name="${name}"
    style="background-image: url('${src}'); background-color: ${bgColor}; background-repeat: ${bgRepeat}; background-size: ${bgSize}; background-position: ${bgPosition};"
    class="${class}"
    data-namespace="{{ $this->view->getNamespace() }}"
    data-view="{{ $this->view->getName() }}"
>
    ${context}
</div>
